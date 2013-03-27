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
 * @copyright     Copyright 2013-2014, Vagner Leite http://artforweb.wordpress.com
 * @author		  Vagner Leite (vagnerleitte@outlook.com)
 * @created 	  03-12-2012
 * @link          http://www.viibe.com.br
 * @version       Sistema v 0.1
 * @package		  root/system/helpers
 */


/**
 * Cria Elementos HTML para a aplicação
 */
class HTMLHelper {
	
	public function Doctype($Hmtl5=false, $Lang='pt-br'){
		
		if($Hmtl5 == false){
			$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\r\n";
			$html.=	'<html xmlns="http://www.w3.org/1999/xhtml">'."\r\n";
			$html.= '<head>'."\r\n";	
		}
		
		else{
			$html = '<!DOCTYPE html>'."\r\n";
			$html.=	'<html lang="'.$Lang.'">'."\r\n";
			$html.= '<head>'."\r\n";
			}
	     
		echo $html;
		
	}
	
	/**
	 * Cria o charset da pagina
	 * @param String Charset
	 * @param Boolean Html5
	
	 * 
	 * 
	 */
	public function Charset( $Html5 = false, $Charset="UTF-8")
	{
		if($Html5 == false)
		echo $CharsetReturn = '<meta http-equiv="Content-Type" content="text/html; charset='.$Charset.'" />'."\r\n";
		else
		echo $CharsetReturn = '<meta charset="'.$Charset.'">'."\r\n";
	}
	
	/**
	 * Metodo Meta()
	 * Cria metatags HTML
	 * @param String Name O nome da metatag
	 * @param String Value O valor da metatag
	 * 
	 */
	public function Meta($Name, $Value){
		echo '<meta name="'.$Name.'" content="'.$Value.'">'."\r\n";	
	}
	
	/**
	 * Metodo Title()
	 * Cria a tag de t�tulo 
	 * @param String Title O t�tulo do site.
	 * 
	 */
	public function Title($Title = 'My first Application With Simple'){
		echo '<title>'.$Title.'</title>'."\r\n";
	}

	/**
	 * Metodo Css()
	 * Importa ou incorpora um arquivo css;
	 * @param String File Nome do Arquivo a ser carregado
	 * @param Array Options  Array de op��es extras. Ex.: array('media'=>'screen')
	 * 
	 */
	public function Css($File = null, $Import=false, $options = array(), $template='default'){
		$opt ='';	
		foreach ($options as $key => $value) {
			@$opt .= ' '.$key.'="'.$value.'" '; 
		}
		
		if($File != null):
			if($Import == true):
				echo '<style type="text/css">@import url("'.TEMPLATES.$template.'/css/'.$File.'.css");</style>'."\r\n";
			else:
				echo '<link rel="stylesheet" href="'.TEMPLATES.$template.'/css/'.$File.'.css" '.$opt.'>'."\r\n";
			endif;
		endif;
	}

	public function Js($File = null, $Remoto=false, $options = array(), $template='default' ){
		$opt ='';
		foreach ($options as $key => $value) {
			@$opt .= ' '.$key.'="'.$value.'" '; 
		}
		
		if($File != null):
			if($Remoto == true):
				echo '<script type="text/javascript" src="'.$opt.'"></script>'."\r\n";
			else:
				echo '<script type="text/javascript" '.$opt.' src="'.TEMPLATES.$template.'/js/'.$File.'.js"></script>'."\r\n";
			endif;
		endif;
	}
	
	public function Body($EndBody = false){
		if($EndBody == false){
		$body = '</head>'."\r\n";
		$body.= '<body>'."\r\n";
		}else{
		$body = '</body>'."\r\n";
		$body.= '</html>'."\r\n";
			
		}
		echo $body;
	}
	
	public function Link($Label = null, $Href = '#', $Options = array()){
		$opt = '';
		foreach ($Options as $key => $value) {
			$opt .=' '.$key.'="'.$value.'"';
		}
			
		if($Label != null):
			$Link = '<a href="'.PATH_ROOT.$Href.'" '.$opt.'>'.$Label.'</a>'."\r\n";
		endif;
		echo $Link;
	}
	
	public function Image($Href = '#', $Options = array(), $template='default', $upload = false, $folder=null){
		$opt = '';
		foreach ($Options as $key => $value) {
			$opt .=' '.$key.'="'.$value.'"';
		}
		if($folder != null)
			$folder = $folder.'/';
		
		if($Href != null && $upload == false):
			$Img = '<img src="'.TEMPLATES.$template.'/img/'.$Href.'" '.$opt.'/>'."\r\n";
		elseif($Href != null && $upload == true):
			$Img = '<img src="'.PUBLIC_DIR.'uploads/fotos/'.$folder.$Href.'" '.$opt.'/>'."\r\n";
		endif;
		return $Img;
	}
}
