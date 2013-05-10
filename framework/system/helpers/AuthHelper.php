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
 * Helper para auxílio à autenticação de usuários
 */
 
 class AuthHelper{
		
		/**
		 * @param protected AuthModel
		 * Armazena uma instância da classe AuthModel.
		 */
		protected $authModel;
		
		/**
		 * @param protected sessionHelper
		 * Armazena uma instância da classe SessionHelper.
		 */
		 protected $sessionHelper;
		 
		 /**
		  * @param protected redirectorHelper
		  * Armazena uma instância da classe RedirectorHelper.
		  */
		
		/**
		 * @param protected user
		 * Armazena o identificador de acesso (nome de usuário ou email)
		 * fornecido pelo usuário no momento do login.
		 */
		 protected $user;
		 
		 /**
		  * @param protected pass
		  * Armazena a senha informada pelo usuário no momento do login
		  */
		protected $pass;
		/**
		 * Método construtor
		 * Cria novas instâncias das classes necessárias à execução desse script
		 */
		public function __construct(){
			$this->authModel		= new AuthModel;
			$this->sessionHelper 	= new SessionHelper;
			$this->redirectorHelper = new RedirectorHelper;

			return $this;	
		}
		
		/**
		 * Armazena o nome de acesso informado pelo usuário no login.
		 * Esse valor pode corresponder ao nome de usuário ou ao endereço
		 * de email do mesmo. 
		 * @param string  $loginUser Nome de usuário ou email de acesso ao site
		 * 
		 */
		public function setUser( $loginUser ){
			$this->user = $loginUser;
			return $this;
		}
		
		/**
		 * Armazena a senha informada pelo usuário no login.
		 * @param string $password Senha do usuário.
		 */
		public function setPass( $password ){
			$this->pass = $password;
		return $this;
		}
		
		/**
		 * Define para qual controler/action a página será redirecionada após o login
		 * @param string $controller Nome do Controller
		 * @param string $action	 Nome da Action
		 */
		public function setLoginControllerAction( $controller, $action ){
			$this->loginController	= ($controller =='')? '' : $controller;
			$this->loginAction		= ($action == '')?'' :$action;
			return $this;
		}
		
		/**
		 * Define para qual controller/action a página será redirecionada após o logout
		 * @param string $controller Nome do Controller
		 * @param string $action	 Nome da Action 
		 */
		public function setLogoutControllerAction( $controller, $action ){
			$this->logoutController	= ($controller =='/')? '' : $controller;
			$this->logoutAction		= ($action == '/')?'' :$action;
			return $this;
		}
		
		
		/**
		 * Executa a verificação dos dados no banco de dados e retorna o valor correspondente
		 * Grava a sessão se o login for feito com sucesso.
		 * Redireciona e seta mensagem de erro caso o login falhe.
		 * @param string $loginUser Nome de usuário ou email de acesso ao site
		 * @param string $password Senha do usuário.
		 */
		public function Login(){
			$this->sessionHelper->DeleteSession("uauth")
								->DeleteSession("udata");
			
			$loginType = 'U';

			if(true == $this->IsEmail())			
				$loginType = 'E';

			$Params = array('UserPass'=>$this->pass, 'LoginName'=>$this->user, 'LoginType'=>$loginType);

			$Return =  $this->authModel->DoLogin($Params);
			
			if(isset($Return[0])){
				$this->sessionHelper->CreateSession("uauth", true)
									->CreateSession("udata", $Return[0]);
				
				
				return true;
			}
			else{
				$this->sessionHelper->setFlash('Usuário e/ou senha inválidos', 'default', array('class'=>'alert-error'));
				return false;
			}
			
			
			
		}
		
		public function IsEmail(){
			if(strstr($this->user, '@'))
				return true;
			else
				return false;
		}
		
		public function Logout(){
			$this->sessionHelpers->DeleteSession("uauth")
								 ->DeleteSession("udata");
			return $this;
		}
		
		public function CheckLogin( $level = 'public' ){
				if($this->sessionHelper->CheckSession('uauth') === false)
					$this->redirectorHelper->goToControllerAction('accounts', 'login');
				/*else if($this->sessionHelper->CheckSession('uauth') === true){
					$user = $this->sessionHelper->CheckSession('udata');
					if($user['level'] != $level)
					$this->redirectorHelper->goToControllerAction('error', 'forbidden');
				}*/
		}

		public function GetUserLevel(){
			
		}

		public function userData( $key ){
			$s = $this->sessionHelper->SelectSession("userData");
			return $s[$key];
		}
	}
