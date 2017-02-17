<?php //ApplicationModel
/**
* Gère la connexion d'un user
*/
namespace controllers
class LogIn extends Application{

	public function login(){
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
			$user->password($password);

			var_dump($user);

			if($user->checkUserLogin() == false) {
				$user->getUser(); 
				// création du cookie de connexion !
			} else {
				// message d'erreur et retour à la views d'inscription
				echo "l'user n'existe déjà";
			}
		}
	}

	public function logout(){
		
	}

}

?>