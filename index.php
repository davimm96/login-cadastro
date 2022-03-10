<?php
//Dependência
use Davi\LoginGmail as SessionUser;
use Davi\Usuario;

//Retorna as infomações da sessão do usuário
//$info = \Davi\LoginGmail::getInfo();

require_once __DIR__."/vendor/autoload.php";
$executa = new Usuario();


session_start();
$_SESSION["msgSucesso"] = "";

function sair(){
    session_start();
    session_destroy();
    header("Location: login.php");
    exit();
}

if($_SESSION["sessaoLogin"] != session_id()){
    include SessionUser::isLogged() ?
	    __DIR__.'/google/admin.php' :
	    header('Location: google/logout.php');
}

//sair();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="davimm96">
    <meta name="description" content="Página principal">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" href="css/acesso.css">
    <title>Login-cadastro</title>
</head>
<body>
<main>
    <article id="telaLogado">
        <p>Bem-vindo <?=$info['name']?></p>
        
        <form action="" method="POST">
            <button name="deletarConta">Deletar Conta</button>
            <a href="google/logout.php">
                <button name="sair">Sair</button>
            </a>
        </form>
        <br>
        <p>Logado...</p>
    </article>
<main>
</body>
</html>

<?php
    
        
    
    if(isset($_POST["deletarConta"])){
        $executa->setId($_SESSION["idUsuario"]);
        $executa->deletaUsuarioExecuta();
        sair();
    }
    

    if(isset($_POST["sair"])){
       sair();
    }
    
?>
