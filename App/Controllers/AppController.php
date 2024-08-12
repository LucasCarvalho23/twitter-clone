<?php

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class AppController extends Action {

        public function timeline() {
            session_start();
            if ($_SESSION['id'] != '' && $_SESSION['nome'] != '') {
                $this->render('timeline');
            } else {
                header('Location: /?login=erro');
            }
        }

        public function tweet() {
            session_start();
            if ($_SESSION['id'] != '' && $_SESSION['nome'] != '') {
                $tweet = Container::getModel('Tweet');
                $tweet->__set('id_usuario', $_SESSION['id']);
                $tweet->__set('tweet', $_POST['tweet']);
                $tweet->salvar();
            } else {
                header('Location: /?login=erro');
            }
        }

    }

?>