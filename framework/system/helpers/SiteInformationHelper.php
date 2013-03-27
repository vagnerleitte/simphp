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
class SiteInformationHelper {

	public $Info;

	public function __construct() {
		$this -> Info = new SiteInformationModel;
	}

	public function getSiteInfo() {
		return $this -> Info -> getSiteInformation();
	}

}
