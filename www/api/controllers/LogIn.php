<?php //ApplicationModel
/**
* Gère la connexion d'un user
*/
namespace Controllers;

class LogIn extends Application{

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

}

?>