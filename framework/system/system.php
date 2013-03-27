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
 * @package		  root/system
 */
 
class System {
	 private $_url;
        private $_explode;
        public $_controller;
        public $_action;
        public $_params;
		public $_Alert;
		public $Session;
		public $SiteInformation;
		public $Perfil;

        public function  __construct(){
            $this->setUrl();
            $this->setExplode();
            $this->setController();
            $this->setAction();
            $this->setParams();
			$this->Session 				= new SessionHelper;
	
		}
		
		

        private function setUrl(){
        	
            $_GET['url'] = (isset($_GET['url']) ? $_GET['url'] : 'index/index_action');
            $this->_url = $_GET['url'] .'/' ;
        }

        private function setExplode(){
            $this->_explode = explode( '/' , $this->_url );
			
        }

        private function setController(){
        	if($this->_explode[0] == 'admin')
			$this->_controller = 'admin'.ucfirst($this->_explode[1]);
			else
            $this->_controller = $this->_explode[0];
        }
        
        private function setAction(){
        	if($this->_explode[0] == 'admin')
            $ac = (!isset($this->_explode[2]) || $this->_explode[2] == null || $this->_explode[2] == 'index' ? 'index_action' : $this->_explode[2]);
			else
            $ac = (!isset($this->_explode[1]) || $this->_explode[1] == null || $this->_explode[1] == 'index' ? 'index_action' : $this->_explode[1]);
            
            $this->_action = $ac;
        }

        private function setParams(){
        	if($this->_explode[0] == 'admin')
            unset( $this->_explode[0],$this->_explode[1],$this->_explode[2]);
			else
			unset( $this->_explode[0],$this->_explode[1]);
            array_pop( $this->_explode );

            if ( end( $this->_explode ) == null )
                array_pop( $this->_explode );

            $i = 0;
            if( !empty ($this->_explode) ){
                foreach ( $this->_explode as $val ){
                    if ( $i % 2 == 0 ){
                        $ind[] = $val;
                    }else{
                        $value[] = $val;
                    }
                    $i++;
                }
            }else{
                $ind = array();
                $value = array();
            }
            if( count($ind) == count(@$value) && !empty($ind) && !empty($value) )
                $this->_params = array_combine($ind, $value);
            else
                $this->_params = array();
        }

		public function getCurrentUrl(){
			 $pageURL = 'http';
			 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			 $pageURL .= "://";
			 if ($_SERVER["SERVER_PORT"] != "80") {
			  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			 } else {
			  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			 }
			 return $pageURL;
		}
		public function getParam( $name ) {
			
			if ($name != null) :
				if (array_key_exists($name, $this->_params))
					return $this -> _params[$name];
				else
					return false;
			else :
				return $this -> _params;
			endif;
		}
		
			
		public function run() {
			
			$controller_path = CONTROLLERS . $this -> _controller . 'Controller.php';
			if (!file_exists($controller_path)){
				$controller_path = CONTROLLERS .'ErrorController.php';
				
			}
			
				//$controller_path = ROOT . DS . SYSTEM . DS .'controllers'. DS .'Error404'.'Controller.php';
				//die('Controller inexistente!');
	
			require_once ($controller_path);
			$app = new $this->_controller();
	
			if (!method_exists($app, $this -> _action))
				die('Esta action nao existe.');
	
			$action = $this -> _action;
			$app -> init();
			$app -> $action();
		}

}
