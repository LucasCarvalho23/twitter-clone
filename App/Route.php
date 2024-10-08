<?php

    namespace App;
    use MF\Init\Bootstrap;

    class Route extends Bootstrap {

        protected function initRoutes() {
            
            $routes['home'] = array(
                'route' => '/',
                'controller' => 'IndexController',
                'action' => 'index'
            );
            $routes['signin'] = array(
                'route' => '/signin',
                'controller' => 'IndexController',
                'action' => 'signin'
            );
            $routes['registrar'] = array(
                'route' => '/registrar',
                'controller' => 'IndexController',
                'action' => 'registrar'
            );
            $routes['autenticar'] = array(
                'route' => '/autenticar',
                'controller' => 'AuthController',
                'action' => 'autenticar'
            );
            $routes['timeline'] = array(
                'route' => '/timeline',
                'controller' => 'AppController',
                'action' => 'timeline'
            );
            $routes['tweet'] = array(
                'route' => '/tweet',
                'controller' => 'AppController',
                'action' => 'tweet'
            );
            $routes['quem_seguir'] = array(
                'route' => '/quem_seguir',
                'controller' => 'AppController',
                'action' => 'quemSeguir'
            );
            $routes['acao'] = array(
                'route' => '/acao',
                'controller' => 'AppController',
                'action' => 'acao'
            );
            $routes['remover'] = array(
                'route' => '/remover',
                'controller' => 'AppController',
                'action' => 'remover'
            );
            $routes['logout'] = array(
                'route' => '/logout',
                'controller' => 'AuthController',
                'action' => 'logout'
            );

            $this->setRoutes($routes);
            
        }

    }

?>