<?php 
/**
* ////////////////////////////
* @var ...userModel
* ////////////////////////////
*/
namespace model;

require_once($_SERVER['DOCUMENT_ROOT'].'api/models/ApplicationModel.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'api/models/constantes.php');
class UserModel extends ApplicationModel{
	//----------[ CONSTANTS ]----------
	const TABLE_NAME = 'user';
	//----------[ ATTRIBUTS ]----------
	private $id;
	private $username;
	private $firsname;
	private $lastname;
	private $birthdate;
	private $mail;
	private $password;
	private $description;
	private $planetId;
	private $roleId;

	//----------[ CONSTRUCT ]----------
	function __construct($params = false) {
		if (is_array($params)) {
			foreach ($params as $key => $val) {
				if($key != "password") {
					$this->$key = $val;
				}
			}
		} 
	}

	//----------[ SETTER ]-------------
	public function __set($attr, $value) {
		$func = 'set'.ucfirst($attr);
		if (method_exists($this, $func)) {
			$this->$func($value);
		} else {
			$this->$attr = $value;
		}
		// Action commune à tous les setters (ex : mettre dans l'objet)
	}

	private function setUsername($username) {
		$this->username = $username;
	}
	private function setMail($mail) {
		$this->mail = $mail;
	}
    private function setPassword($password) {
        return $this->password = $password;
    }
    private function setDescription($description) {
        return $this->description = $description;
    }
    private function setPlanetId($planetId) {
        return $this->planetId = $planetId;
    }
    private function setRoleId($roleId) {
        return $this->roleId = $roleId;
    }
    private function setFirsname($firsname) {
        return $this->firsname = $firsname;
    }
    private function setLastname($lastname) {
        return $this->lastname = $lastname;    
    }
    private function setBirthdate($birthdate) {
        return $this->birthdate = $birthdate;
    }

	//----------[ GETTER ]-------------
	public function __get($attr) {
		if(isset($this->$attr)) {
			return $this->$attr;
		} else {
			//throw new Exception("Unknown attribute",1);
		}
	}
	//----------[ FUNCTIONS ]----------
	/**
	 * Check if new user is valid (mail or username already in use)
	 *
	 */
	function checkIsNewUser() {
		/*$sql = "SELECT `username`, `mail` 
				FROM `user` 
				WHERE `username` = '". $this->username ."' 
				AND `mail` = '". $this->mail ."'";*/
		$bdd = ApplicationModel::dbConnection();
		$bdd->prepare("SELECT `username`, `mail` 
				FROM `user` 
				WHERE `username` = ? 
				AND `mail` = ?;
			");
		$bdd->execute(array($this->username,$this->));
		$result = ApplicationModel::executeQuery($sql,$bdd);
		$fetch=$result->fetchAll(PDO::FETCH_ASSOC);

		if(count($fetch) > 0){
			return false;
		} else {
			return true;
		}
	}
	/**
	 * vérifie si le nom d'utilisateur est libre ou non (
	 * Pour vérification temps réel en front 
	 * (requête ajax)
	 *
	 * @param      <type>  $username  The username
	 */
	function checkUsernameExist($username){
		
	}

	/**
	 * Adds an user in db.
	 *
	 * @param      <type>  $user   The user
	 */
	function addUser() {
		//hash du mdp
		$sql = "INSERT INTO ". self::TABLE_NAME ." ( `username`, `mail`, `password`, `planetId`, `roleId`, `activated`) 
		VALUES ('".$this->username ."' , '". $this->mail ."', '". $this->password ."', ".TERRE.", ".USER.", 0);";
		
		var_dump($sql);
		
		$bdd = ApplicationModel::dbConnection();
		ApplicationModel::executeQuery($sql,$bdd);
	}

	/**
	 * login
	 *
	 * @param      char  $mail      The mail
	 * @param      char  $password  The password
	 */
	function login($mail, $password) {
		// requête bdd, 
		// créer un objet user
		return new self();
	}
	/**
	 * { function_description }
	 */
	function checkUserLogin(){

		$this->password
	}


}

?>