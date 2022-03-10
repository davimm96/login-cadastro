<?php
 use Davi\Usuario;
 use Davi\Captcha;
 use Davi\Valida;
 
 require __DIR__."/vendor/autoload.php";

 $valida = new Valida();
 $executa = new Usuario();
 $captcha = new Captcha();
 
 session_start();

 //captcha
 if (!$captcha->captchaExecute())
    exit("<p>Por favor, preencha o captcha.</p>");

//valida 
if($valida->validaSenha($_POST["senha"]) 
&& $valida->validaEmail($_POST["email"]) 
&& $valida->validaNome($_POST["nome"]))
{
    //Cadastra
    $executa->setNome($_POST["nome"]);
    $executa->setEmail($_POST["email"]);
    $executa->setSenha($_POST["senha"]);
    $executa->executaCadastro();
}
