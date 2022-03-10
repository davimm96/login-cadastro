<?php
namespace Davi;
session_start();

class Valida {
    private $emailRegex = "/^(\w|\.|-){3,20}@\w+\.(com(\.br)?|net)$/i"; // Valida e-mail
    private $minuscula = "/[a-z]{1,}/";
    private $maiuscula = "/[A-Z]{1,}/";
    private $numero = "/[0-9]{1,}/";
    private $especial = "/(\W|_){1,}/";
    private $espaco = "/\s{1,}/";
                
    function validaSenha($senha){
        if(preg_match_all($this->espaco, $senha) < 1)
            if(strlen($senha) >= 8 && strlen($senha) <= 100)
                if(preg_match_all($this->minuscula, $senha) >= 1)
                    if(preg_match_all($this->maiuscula, $senha) >= 1)
                        if(preg_match_all($this->numero, $senha) >= 1)
                            if(preg_match_all($this->especial, $senha) >= 1)
                                return true;
                            else {
                                echo "<p>A senha deve ter caracteres especiais</p>";
                                return false;
                        }else {
                            echo "<p>A senha deve ter números</p>";
                            return false;               
                    }else {
                        echo "<p>Senha deve ter letras maiúsculas</p>";
                        return false;  
                }else {
                    echo "<p>Senha deve ter letras minúsculas</p>";
                    return false;    
            }else {
                echo "<p>A senha deve ter no mínimo 8 caracteres e no máximo 100</p><br>";
                return false;
            }
        else{
            echo "<p>A senha não pode conter espaço vazio</p>";
            return false;
        }
             
                 
    }            

    function validaEmail($email){
        if(preg_match_all($this->espaco, $email) < 1){
            if(preg_match_all($this->emailRegex, $email) > 0)
                return true;
            else {
                echo "<p>E-mail invalido</p>";
                return false;
            }
        }else{
            echo "<p>O e-mail não pode conter espaço vazio</p>";
            return false;
        }
    }

    function validaNome($nome){
        $restoNome = substr($nome, 1);
        $restoNomeMaius = strtolower($restoNome);
       
        if(preg_match_all($this->espaco, $nome) < 1)
            if(strlen($nome) >= 3){
                if($nome[0] == strtoupper($nome[0])){
                    if($restoNome == $restoNomeMaius){
                        return true;
                    }else {
                        echo "<p>O nome deve ter apenas uma letra maiúscula</p>";
                        return false;
                    }
                }else {
                    echo "<p>O nome deve começar com letra maiúscula</p>";
                    return false;
                }
            }else {
                echo "<p>O nome deve ter no mínimo 3 letras</p>";
                return false;
            }
        else{
            echo "<p>O nome não pode conter espaço vazio</p>";
            return false;
        }
    }
}

?>