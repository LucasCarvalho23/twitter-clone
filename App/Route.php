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

            $this->setRoutes($routes);
            
        }

    }

?>