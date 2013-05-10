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
  * Gerencia redirecionamntos do site
  */
	class RedirectorHelper{
		
		protected $parameters = array();
		
		public function go($data){
			header('Location: '.PATH_ROOT.$data);
		}
		
		public function goUrl($data){
			header('Location: '.$data);
		}
		
		public function goToController($controller){
			$controller.$this->getUrlParameters();
			$this->go($controller.$this->getUrlParameters());
		}
		
		public function setUrlParameter($name, $value){
			$this->parameters[$name] = $value;
			return $this;
		}
		
		protected function getUrlParameters(){
			$params ='';
			foreach ($this->parameters as $name => $value){
				 $params .= $name.'/'.$value.'/';
			}
			return $params;
		}
		
		
		public function goToAction($action){
			
			$this->go($this->getCurrentController().'/'.$action.'/'.$this->getUrlParameters());
			
		}
		
		public function goToControllerAction($controller, $action){
			$this->go($controller.'/'.$action.'/'.$this->getUrlParameters());
		}
		
		public function goToIndex(){
			$this->goToController('index');
		}
		
		public function goToUrl( $url ){
			header('Location:'.$url);
		}
		
		function getCurrentAction(){
			global $start;
			return $start->_action;
		}
		
		function getCurrentController(){
			global $start;
			return $start->_controller;
		}
		
	}
