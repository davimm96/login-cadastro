<?php
    namespace Davi;
    use Davi\Sql;
    use PDO;

    session_start();
    
    class Usuario extends Sql {
        private $results;
        //Query deleta usuario
        function deletaUsuario(){
            $this->stmt = $this->conn->prepare("DELETE FROM usuario WHERE usuarioId = :ID");
            $this->idParam();
        }

        //Pegar id do usuario
        function idUsuario(){
            $this->stmt = $this->conn->prepare("SELECT usuarioId FROM usuario WHERE email = :EMAIL");
            $this->emailParam();
        }

        //Query de buscar nome
        function nome(){
            $this->stmt = $this->conn->prepare("SELECT * FROM usuario WHERE nome = :NOME");
            $this->nomeParam();
        }

        //Query de buscar email
        function email(){
            $this->stmt = $this->conn->prepare("SELECT * FROM usuario WHERE email = :EMAIL");
            $this->emailParam();
        }
        
        //Query de buscar senha
        function senha(){
            $this->stmt = $this->conn->prepare("SELECT senha FROM usuario WHERE email = :EMAIL");
            $this->emailParam();
        }

        //Executa
        function executa(){
            if(!$this->stmt->execute())
                var_dump($this->stmt->errorInfo());
            
            $this->results = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //Deleta usuario
        function deletaUsuarioExecuta(){
            $this->deletaUsuario();
            $this->executa();
        }

        //Muda senha
        function mudaSenhaExecuta(){
            $this->stmt = $this->conn->prepare("UPDATE usuario SET senha= :SENHA WHERE email= :EMAIL");
            $this->senhaParam();
            $this->emailParam();
            $this->executa();
            $_SESSION["msgSucesso"] = 'Senha mudada com sucesso';
        }

        //Verifica email
        function verificaEmail(){
            $this->email();
            $this->executa();
            //Verifica se esse email existe
            if (count($this->results) > 0){
                exit();
            }else
                echo "<p>Esse e-mail não está cadastrado</p>";
        }

        //Executa login
        function executaLogin(){
            //Verifica se esse email existe
            $this->email();
            $this->executa();
            if (count($this->results) > 0){
                $this->senha();
                $this->executa();
                $sb;

                foreach($this->results as $a){
                    $sb = $a['senha'];
                }

                if(password_verify($this->getSenha(), $sb)){

                    $this->idUsuario();
                    $this->executa();
                    $ib;

                    foreach($this->results as $a){
                        $ib = $a['usuarioId'];
                    }
                    //verifica se a senha existe
                    if(count($this->results) > 0){
                        //Login
                        //Cria uma sessão e envia para a index
                        session_destroy();
                        session_start();
                        session_regenerate_id();
                        $_SESSION["sessaoLogin"] = session_id();
                        $_SESSION["idUsuario"] = $ib;
                        exit();
                    }
                }else 
                    echo "<p>Senha invalida</p>";
            }else 
                echo "<p>E-mail invalido</p>";  
        }

        //Executa cadastro
        function executaCadastro(){
            $this->email();
            $this->executa();
            //Verifica se esse email exite
            if(count($this->results) > 0)
                echo "<p>Usuario já existe</p>";
            else{
                //Cadastra
                $this->stmt = $this->conn->prepare("
                    INSERT INTO usuario (nome, email, senha) VALUE (:NOME, :EMAIL, :SENHA)
                ");
                $this->nomeParam();
                $this->emailParam();
                $this->senhaParam();
                $this->stmt->execute();
                $_SESSION["msgSucesso"] = "Cadastrado com sucesso";
                //if(!$this->stmt->execute())
                    //var_dump($this->stmt->errorInfo());
                exit();
            }        
        }
    }
?>