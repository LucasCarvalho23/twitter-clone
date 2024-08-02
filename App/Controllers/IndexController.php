<?php

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action {

        public function index() {
            $this->render('index');
        }

        public function signin() {
            $this->render('signin');
        }

        public function registrar() {
            $user = Container::getModel('user');
            $user->__set('nome', $_POST['nome']);
            $user->__set('email', $_POST['email']);
            $user->__set('senha', $_POST['senha']);
            $user->salvar();
        }

    }

?>