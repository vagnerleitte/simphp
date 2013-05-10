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
 * @copyright     Copyright 2013-2014, Vagner Leite http://vagnerleitte.github.io/simphp/
 * @author		  Vagner Leite (vagnerleitte@outlook.com)
 * @created 	  03-12-2012
 * @link          http://vagnerleitte.github.io/simphp/
 * @version       Sistema v 0.1
 * @package		  root/system/helpers
 */

 
 /**
  * Lê arquivos .ini
  */
class IniHelper {
		
	private $File;
	
	
	/*
	 * Le uma linha do arquivo de configuração 
	 */
		
	public function __construct(){
		$this->File = CONFIG . DS . 'config.ini';
		
	}
		
	function GetLine($IName) {
		$data = parse_ini_file($this->File);
		return $data["$IName"];
	}
	
	/*
	 * Altera o valor de uma linha do arquivo de configuração
	 */

	function EditLine($ParamName, $OriginalValue, $NewValue) {
		
		$FileOpen = fopen($this->File, "r");
		
		$Tamanho = filesize($this->File);
		$Original = fread($FileOpen, $Tamanho);
		fclose($FileOpen);
		
		$Edit 	= str_replace("$ParamName=$OriginalValue", "$ParamName=$NewValue", $Original);
		$OpenId = fopen($this->File, "w");
		if(fwrite($OpenId, $Edit)){
			fclose($OpenId);
			return true;
		}
		else{
			fclose($OpenId);
			return false;
		}
		
		
	}

}
