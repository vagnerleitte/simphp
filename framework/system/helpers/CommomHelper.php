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
 
 
class CommomHelper {

	/**
	 * Calcula o intervalo entre duas datas no formato ISO, o intervalo é dado
	 * no formato específicado em intevalor q pode ser
	 * y - ano
	 * m - meses
	 * d - dias
	 * h - horas
	 * n - minutos
	 * default ´se gundos
	 *
	 * @param string $data1
	 * @param string $data2
	 * @param string $intervalo m, d, h, n,y
	 * @return int|string intervalo de horas
	 */
	 
	public $IntVal;
	
	public static function dataDif($data1, $data2, $intervalo) {

		switch ($intervalo) {
			case 'y' :
				$Q = 86400 * 365;
				break;
			//ano
			case 'm' :
				$Q = 2592000;
				break;
			//mes
			case 'd' :
				$Q = 86400;
				break;
			//dia
			case 'h' :
				$Q = 3600;
				break;
			//hora
			case 'n' :
				$Q = 60;
				break;
			//minuto
			default :
				$Q = 1;
				break;
			//segundo
		}

		return round((strtotime($data2) - strtotime($data1)) / $Q);
	}

	public function generatePass($tamanho = 250, $maiusculas = true, $numeros = true, $simbolos = false) {
		// Caracteres de cada tipo
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';

		// Vari&aacute;veis internas
		$retorno = '';
		$caracteres = '';

		// Agrupamos todos os caracteres que poder&atilde;o ser utilizados
		$caracteres .= $lmin;
		if ($maiusculas)
			$caracteres .= $lmai;
		if ($numeros)
			$caracteres .= $num;
		if ($simbolos)
			$caracteres .= $simb;

		// Calculamos o total de caracteres poss&iacute;veis
		$len = strlen($caracteres);

		for ($n = 1; $n <= $tamanho; $n++) {
			// Criamos um número aleatório de 1 at&eacute; $len para pegar um dos caracteres
			$rand = mt_rand(1, $len);
			// Concatenamos um dos caracteres na vari&aacute;vel $retorno
			$retorno .= $caracteres[$rand - 1];
		}

		return $retorno;
	}
	
	
	public function CellColor($Status){
		switch ($Status) {
					case 'W':
						$CellStyle = 'style="background: #FFFF99"';
						break;
					
					case 'F':
						$CellStyle = 'style="background: #CC6600"';
						break;			
					
					case 'T':
						$CellStyle = 'style="background: #33CCFF"';
						break;
					
					case 'P':
						$CellStyle = 'style="background: #FFFF99"';
						break;
					
					case 'N':
						$CellStyle = 'style="background: #FF9999"';
						break;
					
					case 'R':
						$CellStyle = 'style="background: #007700"';
						break;
					
					case 'E':
						$CellStyle = 'style="background: #FFCCFF"';
						break;
					
					default:
						$CellStyle = 'style="background: #FFFFFF"';
						break;
				}
		
		
		return $CellStyle;
	}
	
	
	public function GenerateDateInterval($initDate, $finalDate){
		
		$this->IntVal = array();
		
		$mes_ini = date('m', strtotime($initDate));
		$dia_ini = date('d', strtotime($initDate));
		$ano_ini = date('Y', strtotime($initDate));
		
		
	 	$mes_fim = date('m', strtotime($finalDate));
		$dia_fim = date('d', strtotime($finalDate));
		$ano_fim = date('Y', strtotime($finalDate));
		
		$dini = mktime(0,0,0,$mes_ini,$dia_ini,$ano_ini); // timestamp da data inicial
		$dfim = mktime(0,0,0,$mes_fim,$dia_fim,$ano_fim); // timestamp da data final
			
			while($dini <= $dfim)//enquanto uma data for inferior a outra
			{
			   $d = date("d/m/Y",$dini);      
			   $dt = array($d);//convertendo a data no formato dia/mes/ano
			   $this->IntVal = array_merge((array)$this->IntVal, (array)$dt);
			   $dini += 86400; // adicionando mais 1 dia (em segundos) na data inicial
			}
                		
		return $this->IntVal;
	}
	
	
	/**
	 * Get either a Gravatar URL or complete image tag for a specified email address.
	 *
	 * @param string $email The email address
	 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
	 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	 * @param boole $img True to return a complete IMG tag False for just the URL
	 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
	 * @return String containing either just a URL or a complete image tag
	 * @source http://gravatar.com/site/implement/images/php/
	 */
	public function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
		$url = 'http://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s=$s&d=$d&r=$r";
		if ( $img ) {
			$url = '<img class="gravatar" src="' . $url . '"';
			foreach ( $atts as $key => $val )
				$url .= ' ' . $key . '="' . $val . '"';
			$url .= ' />';
		}
		return $url;
	}
	

}
