<?php
/**
* ////////////////////////////
* @var StardustController
* ////////////////////////////
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
	 * check if a username is free or not
	 * @param  array  $post contain username
	 * @return boolean       true if free to use
	 */
	public function isUsernameFree($post) {
		if(!empty($this->checkRequired(['username'], $post))) {
			throw new \Utils\RequestException('MISSING_FIELDS', 400);
		}
		$result = $this->User->findFirst([
			'fields' => ['username'],
			'conditions' => ['username' => $post['username']]
		]);
		$this->response(!(count($result) > 0 && $result != false), 200);
	}
	/**
	 * check if a mail is free or not
	 * @param  array  $post contain username
	 * @return boolean       true if free to use
	 */
	public function isMailFree($post) {
		if(!empty($this->checkRequired(['mail'], $post))) {
			throw new \Utils\RequestException('MISSING_FIELDS', 400);
		}
		$result = $this->User->findFirst([
			'fields' => ['mail'],
			'conditions' => ['mail' => $post['mail']]
		]);
		$this->response(!(count($result) > 0 && $result != false), 200);
	}
	/**
	* validate the user's registration
	* @return [type] [description]
	*/
	public function validateUser($get) {
		$required = ['mail' , 'hash'];
		if(!empty($this->checkRequired($required, $get))){
			throw new \Utils\RequestException('MISSING_FIELDS', 400);
		}

		$data = array(
			'mail'=>$get['mail'],
			'hash' => $get['hash'],
		);
		$request = [
			'fields' => [
				'id',
				'mail',
				'hash',
			],
			'conditions' => $data
		];
		$result = $this->User->findFirst($request);

		if(count($result) > 0){
			$data['activated'] = 1;
			$data['id'] = $result['id'];
			try {
				$this->User->save($data);
			} catch (\PDOException $e) {
				throw new \Utils\RequestException('Erreur BDD', 400);
			}
		} else {
			throw new \Utils\RequestException('INVALID_DATA', 400);
		}

		$this->response(null, 200);
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

		'.$_SERVER['DOCUMENT_ROOT'] .'/' . \Utils\Router\Router::url('auth.validate') . '?mail='.$to.'&hash='.$data['hash'];

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
			if(!filter_var($post['mail'], FILTER_SANITIZE_EMAIL)){
				throw new \Utils\RequestException('email invalide', 400);
			}
			$birthdate = $post['birthdate'];
			$tmpBirth = explode('-', $birthdate);
			$day = $tmpBirth[2];
			$month = $tmpBirth[1];
			$year = $tmpBirth[0];
			if(!checkdate($month,$day,$year)) {
				throw new \Utils\RequestException('INVALID_DATE', 400);
			}
			$birthdate = $year . '-' . $month . '-' . $day;
			$password = $post['password'] ;
			$data = [
				"username" => $post['username'],
				"mail" => $post['mail'],
				"birthdate" => $birthdate,
				"password" => $password,
				"hash" => md5(rand(0,1000)),
			];
			$this->filterXSS($data);
			$user = new \Models\User();
			$data['password']=password_hash($password, PASSWORD_DEFAULT);
			try {
				$data['id'] = $user->addUser($data);
			} catch (\PDOException $e) {
				throw new \Utils\RequestException('"USER_EXISTING"', 400);
			}
			$this->loadModel('User_Avatar');
			$this->loadModel('Avatar');
			$this->loadModel('User_Title');
			$this->loadModel('Title');
			$defaultAvatar = $this->Avatar->find(
				['fields' => ['id'],
				'conditions' => ['pack' => 0], ]
			);
			$user = $this->User->find([
				'fields' => ['id'],
				'conditions' => [
					'mail' => $data['mail'],
					'username' => $data['username'],
					]
				]);
			$data['id'] = $user[0]['id'];
			foreach ($defaultAvatar as $key => $idAvatar) {
				if($key != 0) {
						$valueA[] = [$data['id'], $idAvatar['id'], 0 ];
				} else {
					$valueA[] = [$data['id'], $idAvatar['id'], 1];
				}
			}

			$defaultTitle = $this->Title->find(
				['fields' => ['id'],]
			);

			foreach ($defaultTitle as $key => $idTitle) {
				if($key != 0) {
						$valueT[] = [$data['id'], $idTitle['id'], 0 ];
				} else {
					$valueT[] = [$data['id'], $idTitle['id'], 1];
				}
			}
			try{
				$this->User_Avatar->insert([
		            'fields' => ['userId', 'avatarId', 'currentAvatar'],
		            'values' => $valueA,

		        ]);
			} catch (\PDOException $e) {
				throw new \Utils\RequestException($e, 400);
			}

			try{
				$this->User_Title->insert([
		            'fields' => ['userId', 'titleId', 'current'],
		            'values' => $valueT,

		        ]);
			} catch (\PDOException $e) {
				throw new \Utils\RequestException($e, 400);
			}
			$this->sendValidationMail($data);
			unset($data['password']);
			unset($data['hash']);
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
		$notAllowed = ['planetId', 'id', 'registerDate', 'hash', 'username', 'password', 'points'];
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
		$request= $this->User->findFirst([
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
			'conditions' => [
				'user.id' => $id,
				'UA.currentAvatar' => 1,
				'userTitle.current' => 1,
			],
		]);
		if(empty($request)) {
			throw new \Utils\RequestException('Unknown user', 404);
		}
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

	public function search($get) {
		$isRequired = $this->checkRequired(['username', 'interest', 'title', 'planet'],$get);
		if(!empty($isRequired) && count($isRequired) === 4) {
			throw new \Utils\RequestException('champs manquant', 400);
		}

		$offset = +($get['offset'] ?? 0);
		$limit = +($get['limit'] ?? 15);
		if ($limit > 15) {
			throw new \Utils\RequestException('limit trop elevee', 416);
		}

        $fields =  ['DISTINCT user.id','user.username',
					'avatar.imagePath', 'avatar.altText',
					'title.honorificTitle', 'planetId'
                ];

		$where = [
			'userTitle.current' => '1',
			'UA.currentAvatar' => '1',
		];
		if(array_key_exists('interest', $get)) {
			$interest = $get['interest'];
			if(is_array($get['interest'])){
				$interest = implode(', ', $get['interest']);
			}
			$this->filterXSS($interest);
			$where['userInterest.interestId'] = [
				'cmp' => 'IN',
				'value' => $interest,
			];
		}
		if(array_key_exists('title', $get)) {
			$this->filterXSS($get['title']);
			$where['OR'] = ['userTitle.titleId' => $get['title']];
		}
		if(array_key_exists('planet', $get)) {
				$this->filterXSS($get['planet']);
			$where['user.planetId'] = $get['planet'];
		}
		if(array_key_exists('username', $get)) {
			$this->filterXSS($get['username']);
			$where['user.username'] = [
				'cmp' => 'LIKE',
				'value' => $get['username'].'%',
			];
		}

		$count = $this->User->findFirst([
			'fields' => [' COUNT(user.id) AS nbuser'],
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
				'table' => 'user_interest',
				'alias' => 'userInterest',
				'from' => 'userId',
				'to' => 'id',
				'JoinTable' =>  'user',
				],
				[
				'table' => 'interest',
				'alias' => 'interest',
				'from' => 'id',
				'to' => 'interestId',
				'JoinTable' => 'userInterest',
				],
			],
			'conditions' => $where,
			'limit' => "$offset, $limit",
            'orderBy' => [
				'key' => 'username',
				'order' => 'ASC',
			],
		]);
		$request[] = ['count' => $count['nbuser']];

        $request += $this->User->find([
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
				'table' => 'user_interest',
				'alias' => 'userInterest',
				'from' => 'userId',
				'to' => 'id',
				'JoinTable' =>  'user',
				],
				[
				'table' => 'interest',
				'alias' => 'interest',
				'from' => 'id',
				'to' => 'interestId',
				'JoinTable' => 'userInterest',
				],
			],
			'conditions' => $where,
			'limit' => "$offset, $limit",
            'orderBy' => [
				'key' => 'username',
				'order' => 'ASC',
			],
		]);


		$offsetPrev = $offset - $limit;
		$offset = $offset + $limit;

		$listUrl = \Utils\Router\Router::url('users.search');
		$this->response($request, 200, [
			'Link' => "\"$listUrl?offset=$offset&limit=$limit\"; rel=\"next\", \"$listUrl?offset=$offsetPrev&limit=$limit\"; rel=\"last\"",
		]);
    }

	/**
	 * lost password procedure
	 * @param  [type] $post [description]
	 * @return [type]       [description]
	 */
	public function lostPassword($post){
		if(!filter_var($post['mail'], FILTER_SANITIZE_EMAIL)){
			throw new \Utils\RequestException('email invalide', 400);
		}
		$mail = $post['mail'];
		$user = $this->User->findFirst([
			'fields' => ['id', 'username', 'hash', 'mail'],
			'conditions' => ['mail' => $mail],
		]);
		if(!empty($user)) {
			try {
				$this->User->save([
					'hash' => md5(rand(0,1000)),
					'id' => $user['id'],
				]);
			} catch (\PDOException $e) {
				throw new \Utils\RequestException('erreur BDD', 400);
			}
			unset($user['id']);
			$this->sendPasswordMail($user);
		}
	}

	/**
	 * send a mail to
	 * @param  array  $data   [description]
	 * @param  boolean $resend
	 */
	public function sendPasswordMail($data){
		$to      = $data['mail'];
		$subject = '[Friendship Trooper]Inscription | Validation';
		$message = '
		Salut '. $data['username'] .'
		Friendship Trooper est heureux de te rendre ton mot de pass !

		Clique sur le lien ci-dessous pour retrouver ton mot de passe.

		'.$_SERVER['DOCUMENT_ROOT'] .'/' . \Utils\Router\Router::url('users.me.newPassword') . '?mail='.$to.'&hash='.$data['hash'];

		$headers = 'From:noreply@fst.dev' . "\r\n";
		mail($to, $subject, $message, $headers);
	}

	/**
	 * change the password
	 * @param array $post
	 */
	public function setNewPassword($post){
		$required = ['mail' , 'hash', 'password'];
		if(!empty($this->checkRequired($required, $post))){
			throw new \Utils\RequestException('MISSING_FIELDS', 400);
		}
		$data = array(
			'mail'=>$post['mail'],
			'hash' => $post['hash'],
		);
		$request = [
			'fields' => [
				'id',
				'mail',
				'hash',
			],
			'conditions' => $data
		];
		$result = $this->User->findFirst($request);
		if(count($result) > 0){
			$password=password_hash($post['password'], PASSWORD_DEFAULT);
			try {
				$this->User->save([
					'id' => $result['id'],
					'password' => $password,
					'hash' => md5(rand(0,1000)),
				]);
			} catch (\PDOException $e) {
				throw new \Utils\RequestException('Erreur BDD', 400);
			}
		} else {
			throw new \Utils\RequestException('INVALID_DATA', 400);
		}

		$this->response(null, 200);
	}
}
