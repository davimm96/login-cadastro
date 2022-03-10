<?php
//Autoload
require __DIR__.'/../vendor/autoload.php';

//Dependências
use Davi\LoginGmail;

//Desloga
LoginGmail::logout();

//Redireciona o usuário para home
header("Location: ../login.php");
exit;