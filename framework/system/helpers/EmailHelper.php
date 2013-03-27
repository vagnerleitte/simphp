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
 
 include_once('lib/phpmailler/class.phpmailer.php');
 
	class EmailHelper extends Controller {
	
	
		protected $From, $Server, $Port, $SmtpUser, $SmtpPass, $Confirmacao, $Smtp, $Info;
		public	  $Destino, $Assunto, $Mensagem, $Remetente, $Headers; 
		
		
		
		public function __construct(){
			$ini = new IniHelper;
			$Inf = new SiteInformationHelper;
			$this->Info = $Inf->getSiteInfo();
			/*define('SMTPHOST', $ini->GetLine('SMTPHOST'));
			define('SMTPPORT', $ini->GetLine('SMTPPORT'));
			define('SMTPUSER', $ini->GetLine('SMTPUSER'));
			define('SMTPPASS', $ini->GetLine('SMTPPASS'));
			*/
			
			$this->Smtp = new PHPMailer(); // INICIA A CLASSE PHPMAILER
			$this->From    	= 'no-reply@server.com.br';
			$this->Server  	= $ini->GetLine("SMTPHOST");
			$this->Port    	= $ini->GetLine("SMTPPORT");
			$this->SmtpUser = $ini->GetLine("SMTPUSER");
			$this->SmtpPass	= $ini->GetLine("SMTPPASS");
			$this->Smtp->IsSMTP(); //ESSA OPÇÃO HABILITA O ENVIO DE SMTP
			$this->Smtp->Port = $this->Port;
			$this->Smtp->Host = $this->Server;
			$this->Smtp->SMTPAuth = TRUE;
			$this->Smtp->Username = $this->SmtpUser;
			$this->Smtp->Password = $this->SmtpPass;
			$this->Smtp->From	  = $this->From;
			$this->Smtp->FromName = 'Administrador - SIC';
			$this->Smtp->WordWrap = 50;
			$this->Smtp->IsHTML(true);
			$this->Smtp->CharSet  = 'UTF-8';
				
		}
		
		
		public function setDestino($Destino){
			return $this->Destino = $Destino;
		}
		
		public function setRemetente($Remetente){
			return $this->Remetente = $Remetente;
		}
		
		public function setAssunto($Assunto){
			return $this->Assunto = $Assunto;
		}
		
		public function setMessage($Message){
			return $this->Mensagem = $Message;
		}
		
		public function setHeaders(){
			$this->Headers  = 'MIME-Version: 1.0' . "\r\n";
			$this->Headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$this->Headers .= 'From: ' . $this->From . "\r\n" .
		             		 'Reply-To: ' . $this->Remetente . "\r\n" . 'X-Mailer: PHP/' .
		             		  phpversion();
		    return $this->Headers;
		}
		
		
		public function Send()
		{
			
			define('SITE_TITULO', $this->Info[0]['SiteTitulo']);
			define('NOME_CIDADE', $this->Info[0]['Cidade']);
			define('EMAIL_CONTENT', $this->Mensagem);
			ob_start();
			include 'app/views/EmailTemplate.php';
			$Mensagem = ob_get_contents();
			ob_end_clean();
											
			$this->Smtp->AddAddress($this->Destino);
			$this->Smtp->Subject = $this->Assunto;
			
			 $this->Smtp->Body = $Mensagem;
			
			
			if(!$this->Smtp->Send())
			return false;
			else 
			return true;
			
		}
	}
