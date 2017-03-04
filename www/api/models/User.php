<?php
/**
* ////////////////////////////
* @var ...userModel
* ////////////////////////////
*/
namespace Models;

class User extends Model{
	//----------[ CONSTANTS ]----------

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
		parent::__construct();
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
	function checkIsNewUser($data) {
		// j'ai besoin d'un OR T-T
		$result=$this->findFirst($data);
		echo "result";
		var_dump($result);
		var_dump(count($result));
		if(count($result) > 0 && $result != false){
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Adds an user.
	 *
	 * @param      array   $data    The datas
	 * @param      integer  $role    The role
	 * @param      integer  $planet  The planet
	 */
	function addUser($data, $role = 3, $planet = 1) {

		$data["planetId"] = $planet; // TERRE
		$data["roleId"] = $role; // user par défaut

		var_dump($data);

		$result=$this->save($data);
		var_dump($this->primaryKeyValue);
		$this->password="ok";
	}
}

?>
