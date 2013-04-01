<?php

/**
 *
 *
 * PHP 5
 *
 * Sistema : Miniframework PHP OO para aplicações web.
 *
 *
 *
 * @copyright     Copyright 2013-2014, Vagner Leite http://vagnerleitte.com.br
 * @author	  Vagner Leite (vagnerleitte@outlook.com)
 * @created 	  03-12-2012
 * @link          http://www.vagnerleitte.com.br
 * @version       v 0.1
 * @package       root/system
 */

/**
 * Classe que abstrai a conexao e comunicação com o banco de dados utilizando
 * a biblioteca PDO disponível no PHP
 */

class Model extends IniHelper {

	/**
	 * @param $db Armazena uma instancia de conexão com o banco de dados
	 * */
	protected $db;


	/**
	 * @param $DbName  Armazena o nome da base de dados a ser utilizada.
	 */
	private $DbName;
	/**
	 * @param $DbUser	Armazena o nome do usuário de acesso ao banco de dados.
	 */
	private $DbUser;

	/**
	 * @param $DbPass	Armazena a senha de acesso ao banco de dados.
	 */
	private $DbPass;

	/**
	 * @param $DbHost	Armazena o endereço do servidor de banco de dados
	 */
	private $DbHost;

	/**
	 * Método construtor.
	 * Inicializa a classe IniHelper que lê o arquivo de configuração
	 * com as informações de acesso ao banco de dados.
	 *
	 * Cria uma nova instância da classe PDO e executa a conexão com o banco de dados.
	 *
	 */
	public function __construct() {

		$ini = new IniHelper;
		$this -> DbName = $dbname = $ini -> GetLine("DBNAME");
		$this -> DbUser = $dbuser = $ini -> GetLine("DBUSER");
		$this -> DbPass = base64_decode($ini -> GetLine("DBPASS"));
		$this -> DbHost = $dbhost = $ini -> GetLine("DBHOST");

		$this -> db = new PDO("mysql:host=" . $this -> DbHost . ";dbname=" . $this -> DbName, $this -> DbUser, $this -> DbPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$this -> db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	}

	

	/**
	 * Executa uma stored procedure no banco de dados
	 * @param string $procedure nome da procedure
	 * @param array $params parâmetros a serem passados para a stored procedure
	 * @param array $return variável de retorno da stored procedure
	 * @param string $type tipo de retorno esperado (SELECT, UPDATE, INSERT, DELETE)
	 */
	public function Execute($procedure, Array $Params, Array $Return = null, $type = null) {

		$PParams = '';

		$p = $Params;

		foreach ($Params as $value) {
			$PParams .= '?,';
		}

		if ($Return != null) {
			$PParams .= '?,';
		}

		$PParams = substr($PParams, 0, -1);
		$callSP = "CALL {$procedure }({$PParams})";
		$count = 1;

		$stmt = $this -> db -> prepare($callSP);

		if ($Return != null)
			$stmt -> bindValue(1, $Return[0], PDO::PARAM_STR);

		foreach ($Params as $value) {
			
			$value = htmlentities($value, null, 'UTF-8');	
			$value = addslashes($value);
			if ($Return != null) {
				$count++;
			}

			$stmt -> bindValue($count, $value);

			if ($Return == null)
				$count++;

		}

		try {
			$stmt -> execute();

		} catch( PDOException $e2) {
			echo '<hr>' . $e2 -> getMessage() . '</pre>';
			echo '<br><hr>' . $callSP . '<hr>';

		}

		if ($type == null || $type == 'select') {
			try {
				$retorno = $stmt -> fetchAll();
				$k = 0;
				if(isset($retorno[0])){
				foreach ($retorno[0] as $key => $value) {
					unset($retorno[0][$k]);
					$k++;
				}
				
				foreach ($retorno[0] as $key => $value ){
			
					$value = html_entity_decode($value, null, 'UTF-8');
					$value = stripslashes($value);
					}	
				}
				

			} catch( PDOException $e2) {
				$retorno = $stmt -> rowCount();
			}

		} else {
			$retorno = $stmt -> rowCount();
		}

		return $retorno;
	}

}
