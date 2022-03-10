<?php
    namespace Davi;
    use Davi\ConectaBD;
    use PDO;
    
    class Sql extends ConectaBD {
        protected $stmt;
        protected $nome;
        protected $email;
        protected $senha;
        protected $idUsuario;
        
        function setNome($nome){
            $this->nome = $nome;
        }

        function setEmail($email){
            $this->email = $email;
        }

        function setSenha($senha){
            $this->senha = $senha;
        }

        function setId($idUsuario){
            $this->idUsuario = $idUsuario;
        }

        function getId(){
            return $this->idUsuario;
        }

        function getNome() {
            return $this->nome;
        }

        function getEmail(){
            return $this->email;
        }

        function getSenha() {
            return $this->senha;
        }

        function nomeParam(){
            $this->stmt->bindParam(":NOME", $this->getNome());
        }

        function emailParam(){
            $this->stmt->bindParam(":EMAIL", $this->getEmail());
        }

        function senhaParam(){
            $hash = password_hash($this->getSenha(), PASSWORD_DEFAULT);
            return $this->stmt->bindParam(":SENHA", $hash);
        }

        function idParam(){
            $this->stmt->bindParam(":ID", $this->getId());
        }
    }
?>