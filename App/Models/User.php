<?php

    namespace App\Models;
    use MF\Model\Model;

    class User extends Model {
        
        private $id;
        private $nome;
        private $email;
        private $senha;

        public function __get($attr) {
            return $this->$attr;
        }

        public function __set($attr, $value) {
            $this->$attr = $value;
        }

        public function salvar() {
            $query = "INSERT INTO usuarios(nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->execute();

            return $this;
        }

        public function validaCadastro() {
            $valido = true;

            if (strlen($this->__get('nome')) < 3) {
                $valido = false;
            }

            if (strlen($this->__get('email')) < 3) {
                $valido = false;
            }

            if (strlen($this->__get('senha')) < 3) {
                $valido = false;
            }

            return $valido;
        }

        public function getUsuarioPorEmail() {
            $query = "SELECT nome, email FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":email", $this->__get('email'));
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function autenticar() {
            $query = "SELECT id, nome, email FROM usuarios WHERE email = :email AND senha = :senha";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":email", $this->__get('email'));
            $stmt->bindValue(":senha", $this->__get('senha'));
            $stmt->execute();
            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!empty($usuario['id']) && !empty($usuario['nome'])) {
                $this->__set('id', $usuario['id']);
                $this->__set('nome', $usuario['nome']);
            }

            return $this;
        }

        public function getAll() {
            $query = "SELECT id, nome, email from usuarios where nome like :nome and id != :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', '%'.$this->__get('nome').'%');
            $stmt->bindValue(':id_usuario', $this->__get('id'));
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function seguirUsuario($id_usuario_seguindo) {
            echo $id_usuario_seguindo;
        }

        public function DeixarSeguirUsuario($id_usuario_seguindo) {
            echo $id_usuario_seguindo;
        }

    }

?>