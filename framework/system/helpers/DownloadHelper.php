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
 
 class DownloadHelper {
	
	public $_PathDownload, $_FileToDownload;
	
	function __construct() {
		
	}
	
	
	public function setPath($path= null){
		return $this->_PathDownload = $_SERVER['DOCUMENT_ROOT'].'\sic\public\uploads\\'.$path;
	}
	
	public function setFileToDownload($filename=null){
		 return $this->_FileToDownload = $this->_PathDownload.$filename;
	}
	
	public function FileDownload($fullPath){
		
		if(file_exists($fullPath)){
			
			$FileDownload  = fopen ($fullPath, "r");
			
				$FileSize  = filesize($fullPath);
	    		$FileParts = pathinfo($fullPath);
				$Extension = strtolower($FileParts["extension"]);
				switch ($Extension) {
			        case "pdf":
			        header("Content-type: application/pdf");
					header("Content-Disposition: attachment; filename=\"".$FileParts["basename"]."\"");
					break;
			        default;
			        header("Content-type: application/octet-stream");
			        header("Content-Disposition: filename=\"".$FileParts["basename"]."\"");
			    }
				
			
			header("Content-length: $FileSize");
		    header("Cache-control: private"); //use this to open files directly
		    while(!feof($FileDownload)) {
		        $buffer = fread($FileDownload, 2048);
		        echo $buffer;
		    }
			fclose ($FileDownload);
			exit;
		}
		
		
		
	}
}
