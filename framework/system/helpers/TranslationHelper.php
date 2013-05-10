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
  * Lê o arquivo de traduçãi do site
  */
	class TranslationHelper{
					
		private $Lang;
		
		public $LangString;
		
		public function __construct($lang){
			$this->Lang = $lang;
		}
		
		public function GetLang($key){
			ob_start();
			include_once(ROOT.'/system/languages/'.$this->Lang.'.php');
			return $lang[$key];

		}		
	}