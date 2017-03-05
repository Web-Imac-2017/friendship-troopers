<?php

namespace Utils\Router;

class Route {

	private $path;
	private $callable;
	private $matches = [];
	private $params = [];

	public function __construct($path, $callable) {
		$this->path = trim($path, '/');  // On retire les / inutils
		$this->callable = $callable;
	}

	/**
	* Permettra de capturer l'url avec les paramètres
	* get('/posts/:slug-:id') par exemple
	**/
	public function match($url) {
		$url = trim($url, '/');
		$path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
		$regex = "#^$path$#i";
		if(!preg_match($regex, $url, $matches)){
			return false;
		}
		array_shift($matches);
		$this->matches = $matches;
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'POST':
			$this->matches['method'] = $_POST;
			break;
			case 'GET':
			$this->matches['method'] = $_GET;
			break;
			default:
			$this->matches['method'] = '';
			break;
		}
		return true;
	}

	private function paramMatch($match) {
		if(isset($this->params[$match[1]])) {
			return '(' . $this->params[$match[1]] . ')';
		}
		return '([^/]+)';
	}

	public function call() {
		if(is_string($this->callable)) {
			$params = explode('#', $this->callable);
			$controller = "Controllers\\" . $params[0];
			$controller = new $controller();
			$action=$params[1];
			return call_user_func_array([$controller,$action], $this->matches);
		} else {
			return call_user_func_array($this->callable, $this->matches);
		}
	}

	public function with($param, $regex) {
		$this->params[$param] = str_replace('(', '(?:', $regex);
		return $this; // On retourne tjrs l'objet pour enchainer les arguments
	}

  	public function getUrl(array $params = []) {
		$search = [];
		$replace = [];

	  	foreach ($params as $k => $v) {
			$search[] = ":$k";
			$replace[] = $v;
		}

		$url = str_replace($search, $replace, $this->path);
		if (substr_count($url, ':') !== 0) {
      		throw new \Exception('bad param count');
    	}

		return $url;
  	}

}
