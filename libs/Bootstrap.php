<?php

class Bootstrap {

	private $_url;
	private $_controller = NULL;

	public function __construct(){
	}

	public function init(){
		$this->_getUrl();
		if(empty($this->_url[0])){
			$this->_loadDefaultController();
			return false;
		}
		$this->_loadExistingController();
		$this->_callControllerMethod();

	}

	protected function _getUrl(){
		$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : NULL;
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$this->_url = explode('/',$url);
	}

	protected function _loadDefaultController(){
		$this->_controller = new Index();
		$this->_controller->loadModel('index');
		$this->_controller->index();
	}

	protected function _loadExistingController(){
		$file = "controllers/" . $this->_url[0]. ".php";
		if(file_exists($file)){
			require $file;
			$this->_controller = new $this->_url[0];
			$this->_controller->loadModel($this->_url[0]);
		} else {
			return ErrorHandler::callError('404');
		}
	}
	protected function _callControllerMethod()
	{
		$length = count($this->_url);
		
		if ($length > 1) {
			if (!method_exists($this->_controller, $this->_url[1])) {
				return ErrorHandler::callError('404');
			}
		}

		
		switch ($length) {
			case 5:
				$this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
				break;

			case 4:
				$this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
				break;
			case 3:
				$this->_controller->{$this->_url[1]}($this->_url[2]);
				break;
			case 2:
				$this->_controller->{$this->_url[1]}();
				break;
			default:
				if (method_exists($this->_controller, 'index'))
				{
					$this->_controller->index();
				}
				break;
		}
	}
}