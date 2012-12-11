<?php

namespace Log;

class LoggerServiceProvider extends \Silex\Provider\MonologServiceProvider
{
    
    public function register(\Silex\Application $app)
    {
        parent::register($app);
    }
    
    public function boot(\Silex\Application $app)
    {
        $app->before(function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {
            $route = $request->attributes->get('_route');

            $log  = $_SERVER['REMOTE_ADDR'] . ' - ';
            if ($app['session']->has('user') && defined('__USERNAME_METHOD_LOGGED__'))
            {
                $user = $app['session']->get('user');
                $method = __USERNAME_METHOD_LOGGED__;
                $log .= $user->$method();
            }
            if (!empty($route))
                $log .= ' está acessando a rota "' . $route . '" (' . $request->getRequestUri() . ')';
            else
                $log .= ' tentou acessar uma rota inexistente (' . $request->getRequestUri() . ')!';
            $app['monolog']->addInfo($log);
        });
        
        $app->error(function (\Exception $e, $code) use ($app) {
            $msg = ($code != 500) ?
                $e->getMessage() :
                $e->getFile() . ' na linha ' . $e->getLine() . ': ' . $e->getMessage();
            $app['monolog']->addError('cod: ' . $code . ' => ' . $msg);
        });
    }
    
}
