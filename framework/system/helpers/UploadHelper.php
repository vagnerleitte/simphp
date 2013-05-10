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
  * Gerencia o Upload de arquivos do site
  */
 class UploadHelper{
		
		protected $filePath,$path, $file, $fileName, $fileTmpName;
		
		public function setPath( $path ){
			$this->path = $path;
		}

		
		public function setFile( $file ){
			$this->file = $file;
			$this->setFileName();
			$this->setFileTmpName();
			
		}
		public function getFilePath(){
			return $this->FilePath =  $this->path;
		}
		
		public function getFileName(){
			return $this->FilePath =  $this->fileName;
		}
		
		protected function setFileName(){
			$this->fileName = $this->file['name'];
		}
		
		protected function setFileTmpName(){
			$this->fileTmpName = $this->file['tmp_name'];			
		}
		
		public function Upload(){
			if(move_uploaded_file($this->fileTmpName, $_SERVER['DOCUMENT_ROOT'] . $this->path . $this->fileName))
			return true;
			else 
			return false;
		}
		
		
	}
