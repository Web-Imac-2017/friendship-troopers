<?php //ApplicationModel
/**
* Gère l'inscription d'un user
*/
namespace Controllers;

class SignIn extends Application{

	function inscription() {


		$username = htmlspecialchars($_POST['username']);
		$mail = htmlspecialchars($_POST['mail']);
		$password = htmlspecialchars($_POST['password']) ;
		//$birthdate = htmlspecialchars($_POST['birthdate']) ;

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
}
?>