<?php

use Symfony\Component\HttpFoundation\Request as Request,
    Symfony\Component\HttpFoundation\Response as Response;

// CONSTS
define('__ROOT__', __DIR__.'/..');
define('__WEBROOT__', __ROOT__.'/web');
define('__UPLOAD_PATH__', __WEBROOT__.'/midia');
// Nome do atributo do usuário para verificação de autorização
define('__USER_AUTH_ATTR__', 'profile');
// Nome do método a ser chamado pelo Logger para registrar quem está atuando
define('__USERNAME_METHOD_LOGGED__', '__toString');

// Bootstraping e Registrando novas bibliotecas
$loader = require_once __DIR__.'/../vendor/autoload.php';

// Iniciando a App e ligando o debug
$app = new Silex\Application();
date_default_timezone_set('America/Sao_Paulo'); // Timezone padrão
$app['debug'] = true;

// Registrando o Doctrine
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => require_once __ROOT__ . '/config/database.php'
));

// Registrando o Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __ROOT__.'/views'
));

// Registrando o Monolog - objeto para logging
//$app->register(new Log\LoggerServiceProvider(), array(
//    'monolog.name'    => 'MYAPP', // Pode trocar para o nome da sua aplicação
//    'monolog.level'   => $app['debug'] ? \Monolog\Logger::DEBUG : \Monolog\Logger::WARNING,
//    'monolog.logfile' => __ROOT__ . '/log/silex.log',
//    'monolog.handler' => function () use ($app) {
        // Pode-se mudar o handler do log. Para mais classes, veja https://github.com/Seldaek/monolog#handlers
//        return new Monolog\Handler\RotatingFileHandler($app['monolog.logfile'], $app['monolog.level']);
//    }
//));

// Criando novos serviços
$app['auth.login'] = $app->share(function ($app) {
    return new Auth\Authentication($app['session']);
});
$app['auth.permission'] = $app->share(function ($app) {
    return new Auth\Authorization($app['session']);
});

$configLoader = require_once __ROOT__.'/config/loader.php';
$simulation = new Util\Simulation($configLoader);

//$app['dao'] = $app->share(function ($app) {
//    return new Model\DAO\Engine\DaoLoader($app['db']);
//});
//$app['bo'] = $app->share(function ($app) {
//    return new BO\Engine\BoLoader($app['dao']);
//});

// Iniciando a sessão
$app->register(new Silex\Provider\SessionServiceProvider());
$app['session']->start();

// Registrando o Logger de SQL apenas para debug
//if ($app['debug'])
//    $app['db.config']->setSQLLogger(new Log\SilexSkeletonLogger($app['session'], $app['monolog']));

// ==================================================
//     Filtros (antes e depois das requisições)
// ==================================================
$app->before(function (Request $request) use ($app) {
    $route = $request->attributes->get('_route');

    if (!$app['auth.permission']->freePass($route))
    {
        if (!$app['auth.login']->isAuthenticated())
            return $app->redirect('/login');

        if (!$app['auth.permission']->isAuthorized($route))
            return $app->abort(403, $route . ' - Você não pode acessar esta área!');
    }
});

// ==================================================
//             URL's da Aplicação
// ==================================================

// ------------ AUTH Example ------------------------
$app->get('/login', function() use ($app) {
    return $app['twig']->render('auth/login.twig', array(
        'error' => ''
    ));
})->bind('auth.login');

$app->post('/authenticate', function (Request $request) use ($app, $simulation) {
    // carrega as questoes da simulação que foi configurada 
    $questions = $simulation->getQuestions();
    // Modifique o método getUser() em lib/Auth/Authentication.php
    $user_name = $request->get('user');

    if (!empty($user_name)) // Pode modificar para testar outras coisas
    {
        $user = $app['auth.login']->getUser();
        $user->setPermission($request->get('profile'));
        $user->name = $user_name;
        $app['session']->set('user', $user);
        
        $initial = array();
        for ($i = 0; $i < count($questions); $i++)
            $initial[] = $i;
        
        if (!$app['session']->has($user . '-summary'))
            $app['session']->set($user . '-summary', array(
                'Answer' => array(),
                'Review' => array(),
                'Blank'  => $initial
            ));
        
        return $app->redirect('/');
    }
    else
    {
        return $app['twig']->render('auth/login.twig', array(
            'error' => 'Precisa digitar um nome!'
        ));
    }
})->bind('auth.authenticate');

$app->get('/logout', function () use ($app) {
    $app['session']->remove($app['session']->get('user') . '-summary');
    $app['session']->remove('user');
    return $app->redirect('/login');
})->bind('auth.logout');

// ------ HOMEPAGE --------------------
// Showing the question
$app->get('/{number}', function (Request $request, $number) use ($app, $simulation) {
    $questions = $simulation->getQuestions();

    if ($number < 0) return $app->redirect('/');
    if ($number >= count($questions)) return $app->redirect('/' . (int)($number-1));

    $user = $app['session']->get('user');
    $summary = $app['session']->get($user . '-summary');
    $question = $simulation->getQuestion($number, $summary);

    return $app['twig']->render('question.twig', array(
        'number'          => $number,
        'total_questions' => count($questions),
        'question_number' => sprintf('%02d', $number + 1),
        'question'        => $question,
        'summary'         => Util\Summary::html(count($questions), $summary)
    ));
})->value('number', 0)->bind('question.show');

// Saving the questions summary
$app->post('/', function (Request $request) use ($app, $simulation) {
    $number = $request->get('question_number');
    $action = $request->get('action');
    $answer = $request->get('answer');
    $total_questions = count($simulation->getQuestions());
    
    Util\Summary::saveSession($app['session'], $number, $answer, $action);
    
    if ($number+1 >= $total_questions)
        return $app->redirect('/close/exam');
    else
        return $app->redirect('/' . ($number+1));
})->bind('question.action');

// Close the exam. Shows all your answers
$app->get('/close/exam', function () use ($app, $simulation) {
    $user = $app['session']->get('user');
    $summary = $app['session']->get($user . '-summary');

    return $app['twig']->render('close.twig', array(
        'summary'    => Util\Summary::html(count($simulation->getQuestions()), $summary),
        'has_blank'  => Util\Summary::hasBlank($summary),
        'has_review' => Util\Summary::hasReview($summary)
    ));
})->bind('exam.close');

// Shows your result
$app->get('/exam/result', function () use ($app, $simulation) {
    $user = $app['session']->get('user');
    $name = $user->name;
    $questions = $simulation->getQuestions();
    if (!$user) $app->redirect('/');
    $summary = $app['session']->get($user . '-summary');

    $result = Util\Summary::result($summary, $questions);
    
    Util\Summary::save($user, $result, $summary, $questions);
    $app['session']->clear();
    
    return $app['twig']->render('result.twig', array(
        'name'   => $name,
        'result' => $result,
        'total'  => count($questions)
    ));
})->bind('exam.result');

//=====================================================
//    CONTROLADORES
//=====================================================
// Basta incluir um arquivo que está na pasta "controllers"
//require_once 'usuario.php';

//=====================================================
//    Possíveis erros HTTP
//=====================================================
$app->error(function(\Exception $e, $code) use ($app) {
    if (!$app['debug'])
        return $app['twig']->render("errors/$code.twig", array(
            'error' => $e->getMessage()
        ));
});

return $app;
