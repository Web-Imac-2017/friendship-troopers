<?php //ApplicationModel
/**
* Account functions
*/
namespace Controllers;

class Account extends Controller{
	public function __construct() {
		$this->loadModel('User');
	}

	/**
	* login fucntion. Allow user to log in with his account
	* @return [type] [description]
	*/
	public function login($post) {
		if(!empty($this->checkRequired(['mail', 'password'], $post))) {
			throw new \Utils\RequestException('champ manquant', 400);
		}

		if(!filter_var($post['mail'], FILTER_SANITIZE_EMAIL)){
			throw new \Utils\RequestException('email invalide', 400);
		}

		$result = $this->User->findFirst([
			'fields' => ['*'],
			'conditions' => [
				'mail' => $post['mail']
			],
		]);

		if(password_verify($post['password'] , $result['password'])) {
			\Utils\Session::write('User', $result);
		} else {
			throw new \Utils\RequestException('mdp invalide', 400);
		}

		$this->response([
			'id' => $result['id'],
			'planetId' => $result['planetId'],
		], 200, [
			'Location' => \Utils\Router\Router::url('users.me'),
		]);
	}

	/**
	* logout the user. Destroy the session
	* @return [type] [description]
	*/
	public function logout() {
		\Utils\Session::destroy();

		$this->response(null, 204);
	}

/**
* ////////////////////////////
*  	  INSCRIPTION FUNCTIONS
* ////////////////////////////
*/

	/**
	* validate the user's registration
	* @return [type] [description]
	*/
	public function validateUser($get) {
		var_dump($get);
		$required = ['mail' , 'activated'];
		if(!empty($this->checkRequired($required, $get))){
			throw new \Utils\RequestException('MISSING_FIELDS', 400);
		}

		$data = array(
			'mail'=>$get['mail'],
			'activated' => $get['activated'],
		);
		$request = [
			'fields' => [
				'id',
				'mail',
				'activated',
			],
			'conditions' => $data
		];
		$result = $this->User->find($request);
		var_dump($result);
		if(count($result) > 0){
			$data['activated'] = 1;
			$data['id'] = $result[0]['id'];
			try {
				$this->User->save($data);
			} catch (\PDOException $e) {
				throw new \Utils\RequestException('oups', 400);
			}

		} else {
			throw new \Utils\RequestException('INVALID_DATA', 400);
		}
	}

	/**
	 * [sendValidationMail description]
	 * @param  array  $data   [description]
	 * @param  boolean $resend
	 */
	public function sendValidationMail($data){
		$to      = $data['mail'];
		$subject = '[Friendship Trooper]Inscription | Validation';
		$message = '
		Bienvenue dans notre Galaxie, '. $data['username'] .'
		Friendship Trooper est heureux de vous accueillir !

		Il est tant maintenant de valider votre arrivée, simplement en cliquant sur le lien ci dessous !

		'.$_SERVER['DOCUMENT_ROOT'] .'/' . \Utils\Router\Router::url('auth.validate') . '?email='.$to.'&hash='.$data['activated'];

		$headers = 'From:noreply@fst.dev' . "\r\n";
		mail($to, $subject, $message, $headers);
	}

	/**
	* register a new user and send a validation mail
	* @return [type] [description]
	*/
	public function inscription($post) {
		$required = ['username','mail', 'birthdate', 'password'];
		if(!empty($this->checkRequired($required, $post))){
			throw new \Utils\RequestException('champs manquants', 400);
		} else {
			$birthdate = $post['birthdate'];
			$tmpBirth = explode('-', $birthdate);
			$day = $tmpBirth[2];
			$month = $tmpBirth[1];
			$year = $tmpBirth[0];
			if(!checkdate($month,$day,$year)) {
				throw new \Utils\RequestException('Date invalide', 400);
			}
			$birthdate = $year . '-' . $month . '-' . $day;
			$password = $post['password'] ;
			$data = [
				"username" => $post['username'],
				"mail" => $post['mail'],
				"birthdate" => $birthdate,
				"password" => $password,
				"activated" => md5(rand(0,1000)),
			];
			$this->filterXSS($data);
			$user = new \Models\User();
			$data['password']=password_hash($password, PASSWORD_DEFAULT);
			try {
				$data['id'] = $user->addUser($data);
			} catch (\PDOException $e) {
				throw new \Utils\RequestException('utilisateur existe deja', 400);
			}
			$this->loadModel('User_Avatar');
			$this->loadModel('Avatar');
			$defaultavatar = $this->Avatar->find(
				['fields' => ['id'],
				'conditions' => ['pack' => 0], ]
			);
			try{
				$this->User_Avatar->insert([
		            'fields' => ['userId', 'avatarId', 'currentAvatar'],
		            'values' => [$data['id'],'1','1'],

		        ]);
			} catch (\PDOException $e) {
				throw new \Utils\RequestException('oups', 400);
			}
			$this->sendValidationMail($data);
			unset($data['password']);
			unset($data['activated']);

			\Utils\Session::write('User', $data);
			$this->response($data, 201);
		}
	}


	/**
	 * Allow user to change some of his intel
	 * @param  array $post data received from user
	 */
	public function updateAccountInfos($patches){
		if(\Utils\Session::isLoggedIn() == NULL){
            throw new \Utils\RequestException('NOT_LOGGED', 401);
        }
		if(array_key_exists('id', $patches)) {
			throw new \Utils\RequestException('HACKER_SPOTTED', 400);
		}

		foreach ($patches as $patch) {
			switch ($patch['op']) {
				case 'replace':
					$updates[explode('/',$patch['path'])[1]] = $patch['value'];
					break;
				default:
					throw new \Utils\RequestException('bad op', 400);
			}
		}
		$notAllowed = ['planetId', 'id', 'registerDate', 'activated', 'username', 'password', 'points'];
		$fieldsNotAllowed = $this->checkNotAllowed($notAllowed, $updates);
		foreach ($fieldsNotAllowed as $value) {
			unset($updates[$value]);
		}

		$updates['id'] = \Utils\Session::user('id');
		try{
			$this->User->save($updates);
		} catch (\PDOException $e) {
			throw new \Utils\RequestException('erreur', 400);
		}

		$this->response(null, 200);
	}

	/**
	* Delete the account of a user and his post/ comment / etc
	* @return [type] [description]
	*/
	function deleteAccount(){
		//delete user -> usermodel
		//delete userBadge -> userModel
		//delete userSmiley -> userBadge
		//delete post & comment -> publicationModel & commentModel
		//delete like ?
		//supression cookie
		//logout -> userModel
	}


	/**
	 * get a user profil
	 */
	public function getUser($id, $current = false) {
		if (\Utils\Session::isLoggedIn() == NULL) {
            throw new \Utils\RequestException('Vous n\'êtes pas connecté', 401);
        }
        $userId = \Utils\Session::user('id');
		$fields =  ['user.id', 'user.planetId', 'planet.name' , 'user.description', 'user.points', 'username',
					'avatar.imagePath', 'avatar.altText',
					'title.honorificTitle'];

		if($userId=$id && $current === true) {
			$fields[] = 'user.firstname';
			$fields[] = 'user.lastname';
			$fields[] = 'user.birthdate';
		}
		$request= $this->User->find([
			'fields' => $fields,
			'leftJoin' => [
				[
				'table' => 'user_avatar',
				'alias' => 'UA',
				'to' => 'id',
				'from' => 'userId'
				],
				[
				'table' => 'avatar',
				'alias' => 'avatar',
				'from' => 'id',
				'to' => 'avatarId',
				'JoinTable' =>  'UA',
				],
				[
				'table' => 'user_title',
				'alias' => 'userTitle',
				'from' => 'userId',
				'to' => 'id',
				'JoinTable' =>  'user',
				],
				[
				'table' => 'title',
				'alias' => 'title',
				'from' => 'id',
				'to' => 'titleId',
				'JoinTable' => 'userTitle',
				],
				[
				'table' => 'planet',
				'alias' => 'planet',
				'to' => 'planetId',
				'from' => 'id'
				],
			],
			'conditions' => ['user.id' => $id],
		]);
		$this->response($request, 200);
	}

	/**
	 * get the full infos of the current User
	 */
	public function getCurrentUser(){
		if (\Utils\Session::isLoggedIn() == NULL) {
			throw new \Utils\RequestException('Vous n\'êtes pas connecté', 401);
		}
		$userId = \Utils\Session::user('id');
		$this->getUser($userId, true);
	}

}
