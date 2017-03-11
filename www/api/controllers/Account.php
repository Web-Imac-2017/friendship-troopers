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
		$required = ['email' , "activated"];
		if(empty($this->checkRequired($required, $get))){
			throw new \Utils\RequestException('MISSING_FIELDS', 400);
		}

		$data = array(
			'mail'=>$get['email'],
			'activated' => $get['activated'],
		);
		$request =[
			'fields' => [
				'mail',
				'activated'
			],
			'conditions' => $data
		];
		$result = $this->find($request);
		if(count($result) > 0){
			$data['activated'] = 1;
			$this->save($data);
		}else{
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
		$error = $this->checkRequired($required, $post);
		if(!empty($error)){
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
			$avatar = new Avatar();
			try {
				$user->addUser($data);
				$avatar->addUserAvatar(1);
				// $avatar->setCurrentAvatar(1);
			} catch (\PDOException $e) {
				throw new \Utils\RequestException('utilisateur existe deja', 400);
			}

			$this->sendValidationMail($data);
			unset($data['password']);
			unset($data['activated']);
			$this->response($data, 201);
		}
	}


	/**
	 * Allow user to change some of his intel
	 * @param  array $post data received from user
	 */
	public function updateAccountInfos($post){
		if(\Utils\Session::isLoggedIn() == NULL){
            throw new \Utils\RequestException('NOT_LOGGED', 401);
        }
		$data =[];
		$data['id'] = \Utils\Session::user('id');

		if(isset($post['mail']) || !empty($post['mail'])){
			$data['mail'] = $post['mail'];
		}
		if(isset($post['password']) || !empty($post['password'])){
			$data['password'] = password_hash($post['password']);
		}
		if(isset($post['avatar']) || !empty($post['avatar'])){
			$data['avatar'] = $post['avatar'];
		}
		if(isset($post['description']) || !empty($post['description'])){
			$data['description'] = $post['description'];
		}
		if(isset($post['firstname']) || !empty($post['firstname'])){
			$data['firstname'] = $post['firstname'];
		}
		if(isset($post['lastname']) || !empty($post['lastname'])){
			$data['lastname'] = $post['lastname'];
		}
		$user = new \Models\User();
		$this->filterXSS($data);
		$reponse = $user->save($data);
		var_dump($reponse);
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
