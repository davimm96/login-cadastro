<?php
 use Davi\Valida;
 use Davi\Captcha;
 use Davi\Usuario;

 require_once __DIR__."/../vendor/autoload.php";

 $valida = new Valida();
 $mudaSenha = new Usuario();
 $captcha = new Captcha();

session_start();

if(!$captcha->captchaExecute())
    exit("<p>Por favor, preencha o captcha.</p>");

if($valida->validaSenha($_POST["novaSenha"])){
    // muda senha
    $mudaSenha->setSenha($_POST["novaSenha"]);
    $mudaSenha->setEmail($_SESSION["email"]);
    $mudaSenha->mudaSenhaExecuta();
}       
 
?>