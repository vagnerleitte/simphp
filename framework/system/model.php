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
 * @copyright     Copyright 2013, Iggow
 * @author		  Vagner Leite (vagnerleitte@outlook.com)
 * @created 	  17-01-2013
 * @link          http://www.iggow.com
 * @version       Sistema v 0.1
 * @package		  root/system
 */

class Model extends IniHelper {

	protected $db;
	public $_tabela;
	public $_innerTabela;
	public $_innerCampos;
	private $DbName, $DbUser, $DbPass, $DbHost;

	public function __construct() {
		
		$ini = new IniHelper;
		$this->DbName	 = $dbname = $ini->GetLine("DBNAME");
		$this->DbUser	 = $dbuser = $ini->GetLine("DBUSER");
		$this->DbPass	 = base64_decode($ini->GetLine("DBPASS"));
		$this->DbHost	 = $dbhost = $ini->GetLine("DBHOST");
				
		$this -> db = new PDO("mysql:host=" . $this->DbHost.";dbname=".$this->DbName, $this->DbUser, $this->DbPass, array());
		$this -> db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	}

	public function insert(Array $dados) {

		foreach ($dados as $key => $value) {
			$campos[] = $key;
			$valores[] = $value;

		}

		$campos = implode(", ", $campos);
		$valores = "'" . implode("', '", $valores) . "'";
		$sql = "INSERT INTO {$this->_tabela} ({$campos}) VALUES ({$valores})";
		
		return $this -> db -> query($sql);
	}

	public function read($where = null, $limit = null, $offset = null, $orderby = null, $inner = null, $funct = null, Array $fields = null) {

		$where = ($where != null) ? "WHERE {$where}" : '';
		$limit = ($limit != null) ? "LIMIT {$limit}" : '';
		$offset = ($offset != null) ? "OFFSET {$offset}" : '';
		$orderby = ($orderby != null) ? "ORDER BY {$orderby}" : '';
		$inner = ($inner != null) ? " {$inner} " : '';

		$as = ($funct != null) ? $funct : '';
		$str = ($funct != null) ? " " . $funct . "(" : '';

		if ($fields != null)
			foreach ($fields as $value) {
				
				$str .= " $value,";
			}
		else {
			$str .= " * ";
		}

		$str = substr($str, 0, -1);

		$str .= ($funct != null) ? ") AS " . $as : '';

		$sql = "SELECT {$str} FROM {$this->_tabela} {$inner} {$where}  {$orderby} {$limit} {$offset} ";
		echo $sql;
		$q = $this -> db -> query($sql);
		$q -> setFetchMode(PDO::FETCH_ASSOC);
		return $q -> fetchAll();
	}

	public function update(Array $dados, $where) {

		foreach ($dados as $key => $value) {
			$campos[] = "{$key} = '{$value}'";

		}
		$campos = implode(", ", $campos);
		return $this -> db -> query("UPDATE `{$this->_tabela}` SET {$campos} WHERE {$where}");

	}

	public function delete($where) {
		return $this -> db -> query("DELETE FROM `{$this->_tabela}` WHERE {$where}");
	}

	public function numrows($resource) {

	}

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
		$callSP = " CALL {$procedure }({$PParams}) ";
		$count = 1;
	
		$stmt = $this -> db -> prepare($callSP);

		if ($Return != null)
			$stmt -> bindValue(1, $Return[0], PDO::PARAM_STR);

		foreach ($Params as $value) {

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
			echo '<br><hr>'.$callSP.'<hr>';

		}

		if ($type == null || $type == 'select'){
			try {
				return $stmt -> fetchAll();
			} catch( PDOException $e2) {
				return $stmt-> rowCount();
			}
				
		}
			
		else
			return $stmt-> rowCount();
	}

}