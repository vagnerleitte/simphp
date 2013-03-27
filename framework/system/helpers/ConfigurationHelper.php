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
 * @author		  Iggow Developers
 * @created 	  17-01-2013
 * @link          http://www.iggow.com
 * @version       Sistema v 0.1
 * @package		  root/system/helpers
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
		return $this -> Info -> Execute('PD_SIC_SalvaConfiguracoes', $Params, null, 'select');
	}

}
