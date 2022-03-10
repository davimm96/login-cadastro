<?php
use Davi\Captcha;
use Davi\Valida;
use Davi\Usuario;

require_once __DIR__.'/../vendor/autoload.php';

$captcha = new Captcha();
$valida = new Valida();
$executa = new Usuario();

if(!$captcha->captchaExecute())
    exit("<p>Por favor, preencha o captcha.</p>");

if($valida->validaEmail($_POST["email"])){
    //se está em formato de e-mail
    //Cria uma sessão para próxima etapa
    session_destroy();
    session_start();
    session_regenerate_id();
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["emailEnviado"] = false;
    $_SESSION["sessaoTrocarSenha"] = session_id();
    //verifica se o email existe
    $executa->setEmail($_POST["email"]);
    $executa->verificaEmail();
    exit(); 
}
?>