<?php

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class AuthController extends Action {

        public function autenticar() {
            $user = Container::getModel('user');
            $user->__set('email', $_POST['email']);
            $user->__set('senha', md5($_POST['senha']));
            $return = $user->autenticar();
   
            if ($user->__get('id') != '' && $user->__get('nome') != '') {
                session_start();
                $_SESSION['id'] = $user->__get('id');
                $_SESSION['nome'] = $user->__get('nome');
                header('Location: /timeline');
            } else {
                header('Location: /?login=erro');
            }
        }

        public function logout() {
            session_start();
            session_destroy();
            header('Location: /');
        }

    }

?>