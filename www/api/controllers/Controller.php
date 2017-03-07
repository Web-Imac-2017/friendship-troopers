<?php
/**
* ////////////////////////////
* @var ApplicationController
* ////////////////////////////
*/
namespace Controllers;

abstract class Controller {

	/**
	 * Check the required fields in the method
	 * @param  array 	$required 	required fields for specific needs
	 * @param  array 	$post 			the datas sent by the method on call
	 * @return [type]	[] 					[description]
	 */
	public function checkRequired ($required, $method) {
		// MAK SURE EACH REQUIRED FIELDS EXISTS IN $_POST
		return array_filter($required, function ($r) use ($method) {
			return !array_key_exists($r, $method);
		});
	}

	/**
	* Filter XSS attempts comming from client users
	* @param  array 	$data 	datas send by controllers when needed
	* @return [type] 	[]     [description]
	*/
	public function filterXSS ($data) {
		$currentData = $data;
		if (!isset($currentData))
			return -1;

		if (!is_array($currentData)) {
			$currentData = htmlspecialchars($currentData);
		} else {
			foreach ($currentData as &$value) {
				$value = htmlspecialchars($value);
			}
			unset($value);
		}
		return $currentData;
	}

	/**
	 * Filter CSRF attempts comming from client users
	 * @return [type] 	[] 				[description]
	 */
	public function filterCSRF () {

	}

	/**
	 * Give a complete response to front. HTTP code and headers as well
	 * @param  array 		$data 			the soon to become json object
	 * @param  integer 	$httpCode 	the http code corresponding
	 * @param  array 		$headers 		optionnal parameter (prepared links to ease front job)
	 * @return [type] 	[] 					[description]
	 */
	public function response($data, int $httpCode = 200, array $headers = []) {
	header('Content-Type: application/json; charset=utf-8');
	foreach ($headers as $k => $v) {
	header("$k: $v");
	}
	http_response_code($httpCode);
	if ($data !== null) {
	echo json_encode($data);
	}

	return $this;
	}

	public function loadModel($name) {
	$className = '\Models\\'.$name;
	$this->$name = new $className();
	}
}
