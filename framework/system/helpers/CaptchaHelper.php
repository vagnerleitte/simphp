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
 * Gera e checa captchas 
 *
 */
 class CaptchaHelper{
	
	/**
	 * @param $font;
	 * Armazena a Família da fonte utilizada no Captcha
	 */
	private $font;
	
	/**
	 * @param $cor1;
	 * Define a cor de fundo do CAPTCHA
	 */
	
	private $cor1;
	
	/**
	 * @param $cor2;
	 * Define a cor do texto do CAPTCHA
	 */ 
	private $cor2;
	
	/**
	 * @param $captchaValue;
	 * O Valor gerado para o CAPTCHA 
	 */
	private $captchaValue;
	
	/**
	 * @param $imagem;
	 * Armazena a imagem (resource)
	 */
	public $imagem;
	
	
	/**
	 * Método construtor
	 * Define configurações básicas para execução do CAPTCHA
	 */
	public function __construct() {
		// define o tipo do arquivo e configura os cabeçalhos		
		header("Content-type: image/jpeg"); 
		// define o nome da fonte a ser usada.
		// essa fonte devera estar no mesmo diretório da classe
	  	$this->font = dirname(__FILE__) . '/CHILLER.TTF'; 
	  	
	}
	
	
	/**
	 * Método que cria a imagem
	 * @param $altura 
	 * Define a altura da imagem em pixels
	 * @param $largura
	 * Define a largura da imagem em pixels
	 */
	public function CreateImage($altura, $largura){
		// define a largura e a altura da imagem
		$this->Imagem = imagecreate($largura, $altura); 
		// define a cor branco sujo
		$this->cor1 = imagecolorallocate($this->Imagem,245,245,245);
		// define a cor vermelha 
        $this->cor2 = imagecolorallocate($this->Imagem,255,0,0); 
        return $this;
    }
	
	/**
	 * Método que gera letras
	 * @param $quantidadeLetras
	 * Define a quantidade de letras usadas no CAPTCHA
	 */
	public function GenerateLetters($quantidadeLetras){
		// gera uma string aleatória com os caracteres
		// AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvYyXxWwZz23456789
		$this->CaptchaValue = substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvYyXxWwZz23456789"),0,($QuantidadeLetras));
		// atribui a palavra gerada à uma sessão 
        $_SESSION["cpt_value"] = $this->CaptchaValue; 
        return $this;
	}
	
	/**
	 * Médoto que adiciona a string gerada à imagem
	 * @param $quantiadeDeLetras
	 * Quantidade de caracteres usado no CAPTCHA
	 * @param $tamanhoFont
	 * Tamanho da fonte usada no CAPTCHA
	 */
	public function AddLettersToImage($quantiadeDeLetras, $tamanhoFonte){
		for($i = 1; $i <= $quantiadeDeLetras; $i++){ 
            imagettftext($this->Imagem,$tamanhoFonte,rand(-25,25),($tamanhoFonte*$i),($tamanhoFonte + 10),$this->Cor2,$this->Font,substr($this->CaptchaValue,($i-1),1)); // atribui as letras a imagem
        }
		// gera a imagem
        imagejpeg($this->imagem); 
        // limpa a imagem da memoria
        imagedestroy($this->imagem); 
	}
		
}