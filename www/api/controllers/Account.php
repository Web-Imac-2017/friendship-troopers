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
		Session::destroy();

		$this->response(null, 204);
	}

	/**
	* validate the user's registration
	* @return [type] [description]
	*/
	public function validateUser($get) {
		if(isset($get['email']) && !empty($get['email']) AND isset($get['activated']) && !empty($get['activated'])){
			$data = array(
				'mail'=>$get['email'],
				'activated' => $get['activated']
			);
			$request = array(
				'fields' => array(
					'mail',
					'activated'),
					'conditions' => $data
				);
				$result = $this->find($request);
				if(count($result) > 0){
					$data['activated'] = 1;
					$this->save($data);
				}else{
					$error = array(0=>'lien invalide');
					return json_encode($error);
				}
		} else {
			header("HTTP/1.0 404 Not Found");
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
		$error = array();
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
				"activated" => 0,
			];
			$this->filterXSS($data);
			$user = new \Models\User();
			$data['password']=password_hash($password, PASSWORD_DEFAULT);

			try {
				$user->addUser($data);
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
		$data = array();
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
	 *get a user
	 * @return [type] [description]
	 */
	public function getUser($username) {
		echo "getUser start";
		if(!isset($username) || empty($username)){
			return 0;
		}
		$user = new \Models\User();
		$request = array();
		if(array_key_exists('user',$_SESSION) && $username == $_SESSION['user']['username']){
			$request['fields'] = '*';
		} else {
			$request['fields'] = array(
				'username',
				'description',
				'avatarId'
			);
		}
		$request['leftJoin'] = array(
			'table' => 'user_avatar',
			'alias' => 'UA',
			'to' => 'id',
			'from' => 'userId'
		);
		// SELECT username, description, avatarId FROM user AS user
		// LEFT JOIN user_avatar AS UA ON User.id = UA.userId
		// WHERE user.username='lol' AND UA.currentAvatar=1
		$request['conditions'] = array(
			'username' => $username
		);
		$result = $user->find($request);
		if(count($result) == 1){
			var_dump($result);
		} else {
			echo 'user not found';
		}
	}
}
