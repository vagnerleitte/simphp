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
 * Gerencia Downloads
 */

class DownloadHelper {

	public $_PathDownload;
	
	public $_FileToDownload;

	public function setPath($path = null) {
		return $this -> _PathDownload = $_SERVER['DOCUMENT_ROOT'] . DS . 'public' . DS . 'uploads' . DS . $path;
	}

	public function setFileToDownload($filename = null) {
		return $this -> _FileToDownload = $this -> _PathDownload . $filename;
	}

	public function FileDownload($fullPath) {

		if (file_exists($fullPath)) {

			$FileDownload = fopen($fullPath, "r");

			$FileSize = filesize($fullPath);
			$FileParts = pathinfo($fullPath);
			$Extension = strtolower($FileParts["extension"]);
			switch ($Extension) {
				case "pdf" :
					header("Content-type: application/pdf");
					header("Content-Disposition: attachment; filename=\"" . $FileParts["basename"] . "\"");
					break;
				default :
					header("Content-type: application/octet-stream");
					header("Content-Disposition: filename=\"" . $FileParts["basename"] . "\"");
			}

			header("Content-length: $FileSize");
			header("Cache-control: private");
			//use this to open files directly
			while (!feof($FileDownload)) {
				$buffer = fread($FileDownload, 2048);
				echo $buffer;
			}
			fclose($FileDownload);
			exit ;
		}

	}

}
