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
 * @package		  root/system/helpers
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