<?php //ApplicationModel
/**
* Gère l'inscription d'un user
*/
namespace controllers;

class SignIn extends Application{

	function inscription() {


		$username = htmlspecialchars($_POST['username']);
		$mail = htmlspecialchars($_POST['mail']);
		$password = htmlspecialchars($_POST['password']) ;

		if(!isset($username) || !isset($mail) || !isset($password) || empty($username) || empty($mail) || empty($password)) {
			//renvoyer une erreur à la views
			echo "erreur dans la saisie des champs d'inscription";
			
		} else {
			$password=password_hash($password, PASSWORD_DEFAULT);
			$this->modelLoader('UserModel');
			
			$user = new UserModel();
			$user->mail($mail);
			$user->username($username);
			$user->password($password);

			var_dump($user);

			if($user->checkIsNewUser() == true) {
				$user->addUser(); 
			} else {
				// message d'erreur et retour à la views d'inscription
				echo "l'user existe déjà";
			}
		}		
	}
}
?>