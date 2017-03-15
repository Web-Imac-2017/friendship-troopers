<?php
/**
* ////////////////////////////
* @var ApplicationController
* ////////////////////////////
*/
namespace Controllers;

abstract class Controller {

	/**
	 * Load the principal model to be used more easily
	 * others are loaded by namespaces
	 * @param  string 	$name 	The model name to be loaded
	 * @return [type] 	[] 			[description]
	 */
	public function loadModel($name) {
		$className = '\Models\\'.$name;
		$this->$name = new $className();
	}

	/**
	 * Make sure each required fields exists in the method
	 * @param  array 		$required 	Required fields to be checked
	 * @param  array 		$method 		datas passed by the method
	 * @return [type] 	[] 					[description]
	 */
  public function checkRequired ($required, $method) {
    return array_filter($required, function ($r) use ($method) {
      return !array_key_exists($r, $method);
    });
  }

  public function checkNotAllowed ($notAllowed, $post) {
    // MAK SURE EACH REQUIRED FIELDS EXISTS IN $_POST
    return array_filter($notAllowed, function ($r) use ($post) {
      return array_key_exists($r, $post);
    });
  }


  /**
   * Filter XSS attempts comming from users
   * @param  [type] $data [description]
   * @return [type]       [description]
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

  public function filterCSRF () {

  }

	/**
	 * Prepare and return the response with the HTTP code within
	 * @param  array 		$data				Datas to be transformed in JSON
	 * @param  integer 	$httpCode		the appropriate error or succes code
	 * @param  array 		$headers		optionnal headers to help prepare next requests
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

	/**
	 * Check if an image is really an image and if it's in due format
	 * Only JPEG GIF and PNG are allowed.
	 * @param  image 	$image 		The "to be upload" image
	 * @return [type]	[] 				[description]
	 */
	public function checkImages ($image, $alt) {
		$exImg = exif_imagetype($image);
		$path = ROOT.'/upload/';

		if ($exImg === false) {
			throw new \Utils\RequestException('Le fichier n\'est pas une image !', 400);
		} else if (!in_array($exImg, [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF])) {
			throw new \Utils\RequestException('extention de fichier non supportee !', 400);
		}

		$path .= uniqid(time(), true) . image_type_to_extension($exImg, true);
		$this->loadModel('Imgupload');

		return $this->Imgupload->save([
			'imagePath' => $path,
			'alt' => $alt,
		]);
	}
}
