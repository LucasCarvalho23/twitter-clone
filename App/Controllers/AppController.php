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
            $total_registros_pagina = 10;
            $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
            $deslocamento = ($pagina - 1) * $total_registros_pagina;
            $tweets = $tweet->getPorPagina($total_registros_pagina, $deslocamento);
            $total_tweets = $tweet->getTotalRegistros();
            $this->view->total_de_paginas = ceil($total_tweets['total'] / $total_registros_pagina);
            $this->view->pagina_ativa = $pagina;
            $this->view->tweets = $tweets;
            $usuario = Container::getModel('User');
            $usuario->__set("id", $_SESSION['id']);
            $this->view->info_usuario = $usuario->getInfoUsuario();
            $this->view->total_tweets = $usuario->getTotalTweets();
            $this->view->total_seguindo = $usuario->getTotalSeguindo();
            $this->view->total_seguidores = $usuario->getTotalSeguidores();
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
            $pesquisarPor = isset($_POST['pesquisarPor']) ? $_POST['pesquisarPor'] : '' ;
            $usuario = Container::getModel('user');
            $usuario->__set('id', $_SESSION['id']);
            $this->view->info_usuario = $usuario->getInfoUsuario();
            $this->view->total_tweets = $usuario->getTotalTweets();
            $this->view->total_seguindo = $usuario->getTotalSeguindo();
            $this->view->total_seguidores = $usuario->getTotalSeguidores();
            if ($pesquisarPor != '') {
                $usuario->__set('nome', $pesquisarPor);
                $usuarios = $usuario->getAll();
            }
            $this->view->usuarios = $usuarios;
            $this->render('quemSeguir');
        }

        public function acao() {
            $this->validaAutenticacao();
            $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
            $id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';
            $usuario = Container::getModel('user');
            $usuario->__set('id', $_SESSION['id']);
            if($acao == 'seguir') {
                $usuario->seguirUsuario($id_usuario_seguindo);
            } else if ($acao == 'deixar_de_seguir') {
                $usuario->DeixarSeguirUsuario($id_usuario_seguindo);
            }
            header('Location: /quem_seguir');
        }

        public function remover() {
            $this->validaAutenticacao();
            $id_tweet = isset($_POST['id_tweet']) ? $_POST['id_tweet'] : '';
            $tweet = Container::getModel('Tweet');
            $tweet->__set('id_usuario', $_SESSION['id']);
            if ($id_tweet != '') {
                $tweet->apagarTweet($id_tweet);
            } else {
                echo ("Error. Sem ID vinculado");
            }
            header('Location: /timeline');
        }

    }

?>