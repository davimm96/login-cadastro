<?php
namespace Davi;
use PDO;

class ConectaBD extends PDO {
    protected $conn;
    private static $banco = BANCO;
    private static $login = LOGIN;
    private static $senha = SENHA;

    public function  __construct(){
        $this->conn = new PDO("mysql:dbname=".self::$banco.";host=localhost", self::$login, self::$senha);
    }
}

?>