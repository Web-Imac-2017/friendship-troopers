<?php
/**
* Gère le compte d'un user
*/
namespace Controllers;

class Account extends Controller{
	/**
	 * login fucntion. Allow user to log in with his account
	 * @return [type] [description]
	 */
	public function login(){
		if(!isset($_POST['mail']) || !isset($_POST['password']) || empty($_POST['mail']) || empty($_POST['password'])) {
			//renvoyer une erreur à la views
			echo "erreur dans la saisie des champs d'inscription";
		} else {
			$data =  array(
						"mail" => $_POST['mail'],
						"password" => $_POST['password']
						);
			$this->filterXSS($data);
			$user = new \Models\User();
			$request = array(
					"fields" => array(
							"mail"
							),
					"conditions" => array(
							"mail" => $data['mail']
							)
					);
			if($user->checkIsNewUser($request) == true) {
				// message d'erreur et retour à la views de login
				echo "l'user n'existe pas";
			} else {
				$request['fields'][] = 'password';
				$request['fields'][] = 'username';
				$result=$user->find($request);
				if(password_verify ($data['password'] , $result[0]["password"] )) {
					echo "mdp ok";
					setcookie('username', $result[0]["username"], time() + 365*24*3600);
					$requestUser = array(
						'fields' => '*',
						'conditions' => array(
							'username' => $result[0]["username"]
						));
					$currentUser = $user->find($requestUser);
					$_SESSION['user']= new \Models\user($currentUser[0]);
					header('Location:profil/' . $result[0]["username"]);
				} else {
					echo "erreur mdp";
					header('Location:profil/' . $result[0]["username"]);
				}
			}
		}
	}
	/**
	 * logout the user. Destroy the session
	 * @return [type] [description]
	 */
	public function logout(){
		session_destroy();
		//changer le cookie
		//go to the main page
	}

	function validateUser() {

	}

	/**
	 * register a new user and send a validation mail
	 * @return [type] [description]
	 */
	function inscription() {
		var_dump($_SESSION);

		if(!isset($_POST['username']) || !isset($_POST['mail']) || !isset($_POST['password'])
		|| !isset($_POST['day']) || !isset($_POST['month']) || !isset($_POST['year'])
		|| empty($_POST['day']) || empty($_POST['month']) || empty($_POST['year'])
		|| empty($_POST['username']) || empty($_POST['mail']) || empty($_POST['password'])  ) {
			//renvoyer une erreur à la views
			echo "erreur dans la saisie des champs d'inscription";
		} else {
			$day = $_POST['day'] ;
			$month = $_POST['month'];
			$year = $_POST['year'];
			if(!checkdate($month,$day,$year)) {
				echo "date erronée";
				return 0;
			}
			$birthdate = $year . '-' . $month . '-' . $day;
			$password = $_POST['password'] ;
			$data =  array(
						"username" => $_POST['username'],
						"mail" => $_POST['mail'],
						"birthdate" => $birthdate,
						"password" => $password,
						"activated" => md5(rand(0,1000))
						);
			$this->filterXSS($data);
			$request = array(
					"fields" => array(
							"username",
							"mail"
							),
					"conditions" => [
						'or' => array(
							"username" => $data['username'],
							"mail" => $data['mail'],)
						]
					);
			$user = new \Models\User();

			if($user->checkIsNewUser($request) == false) {
				// message d'erreur et retour à la views d'inscription
				echo "Mail et/ou username existant";
				header('Location:inscription');
			} else {
				$data['password']=password_hash($password, PASSWORD_DEFAULT);
				$user->addUser($data);
				$to      = $data['email'];
				$subject = '[Friendship Trooper]Inscription | Validation';
				$message = '
				Bienvenue dans notre Galaxie'. $data['username'] .'
				Friendship Trooper est heureux de vous accueillir !

				Il est tant maintenant de valider votre arrivée, simplement en cliquant sur le lien ci dessous !

				'.$_SERVER['DOCUMENT_ROOT'] .'/validate?email='.$data['email'].'&hash='.$data['activated'];

				$headers = 'From:noreply@fts.dev' . "\r\n";
				mail($to, $subject, $message, $headers);
			}
		}
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


	function getUser() {
		echo 'oups, pas codée !';
	}
}

?>
