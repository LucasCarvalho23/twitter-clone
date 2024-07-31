<?php

    namespace MF\Controller;

    abstract class Action {

        protected $view;
        
        public function __construct() {
            $this->view = new \stdClass();
        }

        protected function render($view, $tema = 'layout') {
            $this->view->page = $view;
            require_once "../App/Views/".$tema.".phtml";
        }

        protected function content() {
            $classAtual = get_class($this);
            $classAtual = str_replace('App\\Controllers\\', '', $classAtual);
            $classAtual = str_replace('Controller', '', $classAtual);
            $classAtual = strtolower($classAtual);
            require_once "../App/Views/".$classAtual."/".$this->view->page.".phtml";  
        }

    }

?>