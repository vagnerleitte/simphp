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
 
 class CaptchaHelper{
	
	private $Font, $Cor1, $Cor2, $CaptchaValue;
	public $Imagem;
	
	public function __construct() {
		header("Content-type: image/jpeg"); // define o tipo do arquivo
	  	$this->Font = dirname(__FILE__) . '/CHILLER.TTF'; //voce deve ter essa ou outra fonte de sua preferencia em sua pasta
	  	
	}
	
	public function CreateImage($Altura, $Largura){
		$this->Imagem = imagecreate($Largura, $Altura); // define a largura e a altura da imagem
		$this->Cor1 = imagecolorallocate($this->Imagem,245,245,245); // define a cor preta
        $this->Cor2 = imagecolorallocate($this->Imagem,255,0,0); // define a cor vermelha
        return $this;
    }
	
	public function GenerateLetters($QuantidadeLetras){
		$this->CaptchaValue = substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvYyXxWwZz23456789"),0,($QuantidadeLetras)); 
        $_SESSION["cpt_value"] = $this->CaptchaValue; // atribui para a sessao a palavra gerada
        return $this;
	}
	
	public function AddLettersToImage($QuantidadeLetras, $TamanhoFonte){
		for($i = 1; $i <= $QuantidadeLetras; $i++){ 
            imagettftext($this->Imagem,$TamanhoFonte,rand(-25,25),($TamanhoFonte*$i),($TamanhoFonte + 10),$this->Cor2,$this->Font,substr($this->CaptchaValue,($i-1),1)); // atribui as letras a imagem
        }
        imagejpeg($this->Imagem); // gera a imagem
        imagedestroy($this->Imagem); // limpa a imagem da memoria
	}
		
}