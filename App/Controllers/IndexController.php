<?php

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action {

        public function index() {
            $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
            $this->render('index');
        }

        public function signin() {
            $this->view->user = array (
                'nome' => '',
                'email' => '',
                'senha' => ''
            );
            $this->view->erroCadastro = false;
            $this->view->erroDuplicidade = false;
            $this->render('signin');
        }

        public function registrar() {
            $user = Container::getModel('user');
            $user->__set('nome', $_POST['nome']);
            $user->__set('email', $_POST['email']);
            $user->__set('senha', md5($_POST['senha']));

            if ($user->validaCadastro()) {
                $contador = count($user->getUsuarioPorEmail());
                if ($contador == 0) {
                    $user->salvar();
                    $this->render('cadastro');
                } else {
                    $this->view->user = array (
                        'nome' => $_POST['nome'],
                        'email' => $_POST['email'],
                        'senha' => $_POST['senha']
                    );
                    $this->view->erroCadastro = true;
                    $this->view->erroDuplicidade = true;
                    $this->render('signin');
                }
            } else {
                $this->view->user = array (
                    'nome' => $_POST['nome'],
                    'email' => $_POST['email'],
                    'senha' => $_POST['senha']
                );
                $this->view->erroCadastro = true;
                $this->view->erroDuplicidade = false;
                $this->render('signin');
            }

        }

    }

?>