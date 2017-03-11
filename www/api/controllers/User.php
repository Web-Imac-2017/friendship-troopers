<?php //ApplicationModel
/**
* Account functions
*/
namespace Controllers;

class User extends Controller{
	public function __construct() {
		$this->loadModel('User');
	}

	/**
	 * get the list of user. Depend on get parameters.
	 * Allow search bu planetId and role
	 * Restriction on role 'banni'. only admin and modo can access that list
	 * @param  [type] $get [description]
	 * @return [type]      [description]
	 */
	public function usersList($get){
		var_dump($get);
		if(\Utils\Session::isLoggedIn() == NULL){
            throw new \Utils\RequestException('NOT_LOGGED', 401);
        }
		if(array_key_exists('role', $get)) {
			if (!in_array(\Utils\Session::user('roleId'), [1, 2]) && $get['role'] == 4 ) {
		 		throw new \Utils\RequestException('action reservee aux administrateurs', 403);
	   		}
			$conditions['roleId'] = $get['role'];
		}
		if(array_key_exists('planetId', $get)) {
			$conditions['planetId'] = $get['planetId'];
		}
		$request = $this->User->find([
			'fields' => ['username', 'id'],
			'conditions' => $this->filterXSS($conditions),
		]
		);
		$this->response($request, 200);
	}

}
