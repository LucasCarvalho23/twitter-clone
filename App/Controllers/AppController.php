<?php

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class AppController extends Action {

        public function validaAutenticacao() {
            session_start();
            if (!isset($_SESSION['id']) || $_SESSION['id'] == '' || $_SESSION['nome'] == '' || !isset($_SESSION['nome'])) {
                header('Location: /?login=erro');
            } 
        }

        public function timeline() {
            $this->validaAutenticacao();
            $tweet = Container::getModel('Tweet');
            $tweet->__set("id_usuario", $_SESSION['id']);
            $tweets = $tweet->getAll();
            $this->view->tweets = $tweets;
            $this->render('timeline');
        }

        public function tweet() {
            $this->validaAutenticacao();
            $tweet = Container::getModel('Tweet');
            $tweet->__set('id_usuario', $_SESSION['id']);
            $tweet->__set('tweet', $_POST['tweet']);
            $tweet->salvar();
            header('Location: /timeline');
        }

        public function quemSeguir() {
            $this->validaAutenticacao();
            echo "Vasco";
        }

    }

?>