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
 * Gerencia as configurações do site.
 */
 
 
class ConfigurationHelper {

	public $Info;

	public function __construct() {
		$this -> Info = new SiteInformationModel;
	}

	public function getSiteInfo() {
		return $var = $this -> Info -> getSiteInformation();
	}

	public function SalvarConfiguracoes($Params) {
		return $this -> Info -> Execute('PD_SalvaConfiguracoes', $Params, null, 'select');
	}

}
