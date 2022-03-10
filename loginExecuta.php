<?php
use Davi\Usuario;
use Davi\Captcha;
use Davi\Valida;

require __DIR__."/vendor/autoload.php";

$executa = new Usuario();
$valida = new Valida();
$captcha = new Captcha();
session_start();

//Reseta menssagem de cadastro
$_SESSION["msgSucesso"] = "";

//Captcha
if (!$captcha->captchaExecute())
    exit("<p>Por favor, preencha o captcha.</p>");

//Login
$executa->setEmail($_POST["email"]);
$executa->setSenha($_POST["senha"]);
$executa->executaLogin();

