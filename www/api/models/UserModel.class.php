<?php 
/**
* UserModel
*/
require_once($_SERVER['DOCUMENT_ROOT'].'api/models/ApplicationModel.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'api/models/constantes.php');
class UserModel extends ApplicationModel{
	const TABLE_NAME = 'user';

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

	function __construct($params = false) {

		if (is_array($params)) {
			foreach ($params as $key => $val) {
				if($key != "password") {
					$this->$key = $val;
				}
			}
		} 
	}

	public function __set($attr, $value) {
		if(isset($this->$attr)) {
			var_dump($this);
			return $this->$attr = $value;
		} else {
			throw new Exception("Unknown attribute",1);	
		}
	}

	public function __get($attr) {
		if(isset($this->$attr)) {
			return $this->$attr;
		} else {
			throw new Exception("Unknown attribute",1);
		}
	}

	public function setUsername($username) {
		$this->username = $username;
	}
	public function setMail($mail) {
		$this->mail = $mail;
	}
    public function setPassword($password) {
        return $this->password = $password;
    }
    public function setDescription($description) {
        return $this->description = $description;
    }
    public function setPlanetId($planetId) {
        return $this->planetId = $planetId;
    }
    public function setRoleId($roleId) {
        return $this->roleId = $roleId;
    }
    public function setFirsname($firsname) {
        return $this->firsname = $firsname;
    }
    public function setLastname($lastname) {
        return $this->lastname = $lastname;    
    }
    public function setBirthdate($birthdate) {
        return $this->birthdate = $birthdate;
    }

	/**
	 * Gets the user by identifier.
	 *
	 * @param      int  $id     The identifier
	 */
	function getUserById($id) {

	}
	/**
	 * Check if new user is valid (mail or username already in use)
	 *
	 */
	function checkIsNewUser() {
		$sql = "SELECT `username`, `mail` 
				FROM `user` 
				WHERE `username` = '". $this->username ."' 
				AND `mail` = '". $this->mail ."'";
		$bdd = ApplicationModel::dbConnection();
		/*$bdd->->prepare("SELECT `username`, `mail` 
				FROM `user` 
				WHERE `username` = '". $this->username ."' 
				AND `mail` = '". $this->mail ."'";
			");*/
		$result = ApplicationModel::executeQuery($sql,$bdd);
		$fetch=$result->fetchAll(PDO::FETCH_ASSOC);

		if(count($fetch) > 0){
			return false;
		} else {
			return true;
		}
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


}

?>