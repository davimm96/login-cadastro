<?php
use Davi\Captcha;
require_once __DIR__."/../vendor/autoload.php";
$captcha = new Captcha();

session_start();

if(!$captcha->captchaExecute())
    exit("<p>Por favor, preencha o captcha.</p>");

//Verifica se o código digitado é o mesmo que foi gerado
if($_POST["codigo"] == $_SESSION["numVerificacao"]){
    $emailSess = $_SESSION["email"];
    session_destroy();
    session_start();
    session_regenerate_id();
    $_SESSION["sessaoTrocarSenha"] = session_id();
    $_SESSION["email"] = $emailSess;
    exit();
}else 
    echo "<p>Código inválido</p>";  

?>