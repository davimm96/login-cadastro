<?php
namespace Davi;
class LoginGmail {

	/**
	* Métdo resonsável por iniciar a sessão dentro da aplicação
	* @return boolean
	*/  
	private static function init(){
		return session_status() !== PHP_SESSION_ACTIVE ? session_start() : true;
	}

	/**
	* Método responsável por definir a sessão de login do usuário
	* @param string $name
	* @param string $email
	*/

	public static function login($name, $email){
		// Inicia a sessão da aplicação
		self::init();

		//Define a sessão do usuário
		$_SESSION['user'] = [
			'name' => $name,
			'email' => $email
		];
	}

	/**
	* Método responsável por verificar se o usuário está logado
	* @return boolean
	*/

	public static function isLogged(){
		//Inicia a sessão da aplicação
		self::init();

		//Retorna a existência do indice user na sessão
		return isset($_SESSION['user']);
	}

	/**
	* Método responsável por retornar as informções guardadas ma sessão do usuário
	* @return array
	*/
	public static function getInfo(){
		//INICIA A SESSÂO DA PLICAÇÃO
		self::init();

		//Retorna os dados da sessão
		return $_SESSION['user'] ?? [];
	}

	/**
	* Método responsável por delogar o usuário
	*/
	public static function logout(){
		//Inicia a sessão da aplicação
		self::init();

		//Remove a sessão do usuário
		unset($_SESSION['user']);
	} 
}
?>