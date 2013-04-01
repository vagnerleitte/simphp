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
 * @copyright     Copyright 2013-2014, Vagner Leite http://vagnerleitte.com.br
 * @author	  Vagner Leite (vagnerleitte@outlook.com)
 * @created 	  03-12-2012
 * @link          http://www.vagnerleitte.com.br
 * @version       v 0.1
 * @package	  root/system/helpers
 */

/**
 * Cria Elementos HTML para a aplicação
 */
class HTMLHelper {

	public function Doctype($Hmtl5 = false, $Lang = 'pt-br') {

		if ($Hmtl5 == false) {
			$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\r\n";
			$html .= '<html xmlns="http://www.w3.org/1999/xhtml">' . "\r\n";
			$html .= '<head>' . "\r\n";
		} else {
			$html = '<!DOCTYPE html>' . "\r\n";
			$html .= '<html lang="' . $Lang . '">' . "\r\n";
			$html .= '<head>' . "\r\n";
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
	public function Charset($Html5 = false, $Charset = "UTF-8") {
		if ($Html5 == false)
			echo $CharsetReturn = '<meta http-equiv="Content-Type" content="text/html; charset=' . $Charset . '" />' . "\r\n";
		else
			echo $CharsetReturn = '<meta charset="' . $Charset . '">' . "\r\n";
	}

	/**
	 * Metodo Meta()
	 * Cria metatags HTML
	 * @param String Name O nome da metatag
	 * @param String Value O valor da metatag
	 *
	 */
	public function Meta($Name, $Value) {
		echo '<meta name="' . $Name . '" content="' . $Value . '">' . "\r\n";
	}

	/**
	 * Metodo Title()
	 * Cria a tag de título
	 * @param String Title O título do site.
	 *
	 */
	public function Title($Title = 'My first Application With MyFrm') {
		echo '<title>' . $Title . '</title>' . "\r\n";
	}

	/**
	 * Metodo LinkRel()
	 * Crial links relativos no head da página
	 *
	 */

	public function LinkRel($file = null, $template = 'default', $options = array()) {
		$href = '';
		$opt  = '';
		foreach ($options as $key => $value) {
			@$opt .= ' ' . $key . '="' . $value . '" ';
		}
		
		if ($file != null) :
			$tmpUrl = TEMPLATES  . $template . DS . 'img' . DS . $file;
			$href = ' href="'.$tmpUrl.'" ';
		endif;
		
		
		echo $link = '<link'.$opt.$href.'/>'."\r\n";
	}

	/**
	 * Metodo Css()
	 * Importa ou incorpora um arquivo css;
	 * @param String File Nome do Arquivo a ser carregado
	 * @param Bool $Import	Importar arquivo?
	 * @param Array Options  Array de opções extras. Ex.: array('media'=>'screen')
	 * @param String $Template  Nome do template usado.
	 *
	 */
	public function Css($File = null, $Import = false, $options = array(), $template = 'default') {
		$opt = '';
		foreach ($options as $key => $value) {
			@$opt .= ' ' . $key . '="' . $value . '" ';
		}

		if ($File != null) :
			if ($Import == true) :
				echo '<style type="text/css">@import url("' . TEMPLATES . $template . DS . 'css' . DS . $File . '.css");</style>' . "\r\n";
			else :
				echo '<link rel="stylesheet" href="' . TEMPLATES . $template . DS . 'css' . DS . $File . '.css" ' . $opt . '>' . "\r\n";
			endif;
		endif;
	}

	public function Script($File = null, $Remoto = false, $options = array(), $template = 'default') {
		$opt = '';
		foreach ($options as $key => $value) {
			@$opt .= ' ' . $key . '="' . $value . '" ';
		}

		if ($File != null) :
			if ($Remoto == true) :
				echo '<script type="text/javascript" src="' . $opt . '"></script>' . "\r\n";
			else :
				echo '<script type="text/javascript" ' . $opt . ' src="' . TEMPLATES . $template . DS . 'js' . DS . $File . '.js"></script>' . "\r\n";
			endif;
		endif;
	}

	public function Body($EndBody = false) {
		if ($EndBody == false) {
			$body = '</head>' . "\r\n";
			$body .= '<body>' . "\r\n";
		} else {
			$body = '</body>' . "\r\n";
			$body .= '</html>' . "\r\n";

		}
		echo $body;
	}

	public function Link($Label = null, $Href = '#', $Options = array(), $remote = false) {
		$opt = '';
		$Link = '';
		foreach ($Options as $key => $value) {
			$opt .= ' ' . $key . '="' . $value . '"';
		}

		if ($Label != null) :
			if ($remote == true)
				$Link .= '<a href="' . $Href . '" ' . $opt . '>' . $Label . '</a>' . "\r\n";
			else {
				if ($Href != '#')
					$Link .= '<a href="' . PATH_ROOT . $Href . '" ' . $opt . '>' . $Label . '</a>' . "\r\n";
				else
					$Link .= '<a href="#" ' . $opt . '>' . $Label . '</a>' . "\r\n";
			}

		endif;
		echo $Link;
	}

	public function Image($Href = '#', $Options = array(), $template = 'default', $upload = false, $folder = null) {
		$opt = '';
		$Img = '';
		foreach ($Options as $key => $value) {
			$opt .= ' ' . $key . '="' . $value . '"';
		}
		if ($folder != null)
			$folder = $folder . DS;

		if ($Href != null && $upload == false) :
			$Img = '<img src="' . TEMPLATES . $template . DS . 'img' . DS . $Href . '" ' . $opt . '>' . "\r\n";
		elseif ($Href != null && $upload == true) :
			$Img = '<img src="' . PUBLIC_DIR . 'uploads' . DS . 'fotos' . DS . $folder . $Href . '" ' . $opt . '>' . "\r\n";
		endif;
		return $Img;
	}

	public function Form($end = false, $action = null, $options = array(), $method = 'POST', $enctype = 'multipart/form-data') {
		if ($end == false) {
			$form = '<form';

			if ($action == null)
				$form .= ' action="#" ';
			else
				$form .= ' action="' . PATH_ROOT . $action . '" ';

			foreach ($options as $key => $value) {
				$form .= ' ' . $key . '="' . $value . '" ';
			}

			$form .= ' method="' . $method . '" enctype="' . $enctype . '">';
		} else
			$form = '</form>';

		echo $form;

	}

	public function Url($Url = null, $external = false, $print = true) {

		if ($Url != null && $external == false)
			$url = PATH_ROOT . $Url;
		else
			$url = $Url;

		if($print == true)
		echo $url;
		else
		return $url;
	}

}
