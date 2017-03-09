<?php
/**
* ////////////////////////////
* @var StardustController
* ////////////////////////////
*/
namespace Controllers;

class Avatar extends Controller {
    public function __construct() {
      $this->loadModel('Avatar');
      //$this->loadModel('User_Avatar');
    }

    /**
     * add an avatar into the database
     * @param  array $post datas from view
     */
    public function create($post) {
        if(\Utils\Session::isLoggedIn() == NULL){
            throw new \Utils\RequestException('NOT_LOGGED', 401);
        }
        if(\Utils\Session::user('roleId') != 1){
            throw new \Utils\RequestException('FORBIDDEN', 403);
        }
        $required = ['imagePath', 'altText', 'description', 'price'];
        if (!empty($this->checkRequired($required, $post))) {
			throw new \Utils\RequestException('MISSING_FIELDS', 400);
		}
        $fields = [
            'imagePath' => $post['imagePath'],
            'altText' => $post['altText'],
            'description' => $post['description'],
            'price' => $post['price'],
        ];
        if(array_key_exists('pack', $post)) {
            $fields['pack'] = $post['pack'];
        }
        try {
            $this->Avatar->save($this->filterXSS($fields));
        } catch (\PDOException $e) {
            throw new \Utils\RequestException('erreur BDD', 400);
        }
        $this->response('ok',200);
    }

}
