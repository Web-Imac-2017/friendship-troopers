<?php
/**
* Gère le compte d'un user
*/
namespace Controllers;

class Account extends Application{
	public function login(){

		$mail = htmlspecialchars($_POST['mail']);
		$password = htmlspecialchars($_POST['password']) ;

		if(!isset($mail) || !isset($password) || empty($mail) || empty($password)) {
			//renvoyer une erreur à la views
			echo "erreur dans la saisie des champs d'inscription";
		} else {
			$data =  array(
						"mail" => $mail,
						"password" => $password
						);

			$request = array(
					"fields" => array(
							"mail"
							),
					"conditions" => array(
							"mail" => $mail
							)
					);
			$user = new \Models\User();

			if($user->checkIsNewUser($request) == true) {
				// message d'erreur et retour à la views de login
				echo "l'user n'existe pas";
			} else {
				$request['fields'][] = 'password';
				$result=$user->find($request);

				if(password_verify ($data['password'] , $result[0]["password"] )) {
					echo "mdp ok";
					// connection !
					// set cookie
					// session
				} else {
					echo "erreur mdp";
					//retour à la vue de connexion
				}
			}
		}
	}

	public function logout(){
		session_destroy();
		//changer le cookie
		//go to the main page
	}

	function inscription() {
		print_r($_SESSION);
		$username = htmlspecialchars($_POST['username']);
		$mail = htmlspecialchars($_POST['mail']);
		$password = htmlspecialchars($_POST['password']) ;
		$birthdate = htmlspecialchars($_POST['birthdate']) ;

		if(!isset($username) || !isset($mail) || !isset($password) || empty($username) || empty($mail) || empty($password)  ) {
			//renvoyer une erreur à la views
			echo "erreur dans la saisie des champs d'inscription";

		} else {
			$password=password_hash($password, PASSWORD_DEFAULT);
			$data =  array(
						"username" => $username,
						"mail" => $mail,
						);

			$request = array(
					"fields" => array(
							"username",
							"mail"
							),
					"conditions" => $data
					);
			$user = new \Models\User();

			if($user->checkIsNewUser($request) == false) {
				// message d'erreur et retour à la views d'inscription
				echo "l'user existe déjà";

			} else {
				$data["password"] = $password;
				//$data["birthdate"] = $birthdate;
				$user->addUser($data);
			}
		}
	}
	function deleteAccount(){
		//delete user -> usermodel
		//delete userBadge -> userModel
		//delete userSmiley -> userBadge
		//delete post & comment -> publicationModel & commentModel
		//delete like ?
		//supression cookie
		//logout -> userModel
	}
}

?>
