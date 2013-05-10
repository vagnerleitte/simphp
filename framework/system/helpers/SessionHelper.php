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
  * Gerencia Sessões do Site
  */
	class SessionHelper{
		
		
		public function	__construct(){
			@session_start();
			return $this;
		}
		
		public function CreateSession( $name, $value ){
			$_SESSION[$name] = $value;
			return $this;
		}
		
		public function SelectSession( $name ){
			return $_SESSION[$name];
			//return $this;
		}
		
		public function DeleteSession( $name ){
			unset($_SESSION[$name]);
			return $this;
		}
		
		public function CheckSession( $name ){
			return isset($_SESSION[$name]);
		}
		
		
		public function setFlash($message, $element = 'default', $params = array(), $key = 'flash') {
			$this->CreateSession('Message.' . $key, compact('message', 'element', 'params'));
			return $this;
		}
		
		public function flash($key = 'flash', $attrs = array()) {
		$out = false;
		
			if ($this->CheckSession('Message.' . $key)) {
			
			$flash = $this->SelectSession('Message.' . $key);
			
			$message = $flash['message'];
			
			
			if (!empty($attrs)) {
				$flash = array_merge($flash, $attrs);
			}
			
			if ($flash['element'] == 'default') {
				$class = 'message';
				if (!empty($flash['params']['class'])) {
					$class = $flash['params']['class'];
				}
				$out = '<div class="alert '.$class.' span6 pull-right">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							'.$message.'.
						</div>
						<div class="clear"></div>
						';
				//$out = '<div id="' . $key . 'Message" class="' . $class . '">' . $message . '</div>';
				
				
				
			}
			
			
			elseif ($flash['element'] == '' || $flash['element'] == null) {
				$out = $message;
			}
			$this->DeleteSession('Message.' . $key);
			}
	
			return $out;
		}
			
}
