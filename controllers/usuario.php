<?php

use Symfony\Component\HttpFoundation\Request as Request,
    Symfony\Component\HttpFoundation\Response as Response;
    
// Pode usar a variável $app para declarar novas rotas.
// Não esqueça de nomeá-las se for usar Autorização.
$app->get('/usuario', function () use ($app) {
    $cols = $app['bo']['User']->getColLabels();
    $user = new \Model\Usuario();
    $users = array($user);

    return $app['twig']->render('usuario/main.twig', array(
        'cols'  => $cols,
        'users' => $users
    ));
})->bind('user.main');
