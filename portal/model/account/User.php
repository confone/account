<?php
class User extends Model {

	private $dao = null;

    public static function authenticate($email, $passwd) {
    	$userDao = UserDao::getUserByEmailAndPassword($email, $passwd);
    	if (isset($userDao)) {
    		$user = new User($userDao);
    		return $user;
    	} else {
    		return null;
    	}
    }

    public static function register($email, $name, $password, $cpassword) {
		$userDao = new UserDao();
		$userDao->setEmail($email);
		$userDao->setName($name);
		$userDao->setPassword(md5($password));
		$userDao->save();

		if ($userDao->isFromDatabase()) {
    		$user = new User($userDao);
    		return $user;
		} else {
    		return null;
    	}
    }

    public static function cookieLogin($cookieToken) {
		return LookupRememberUserDao::getUserIdByCookieToken($cookieToken);
    }

    public static function removeRememberMeToken($cookieToken) {
		LookupRememberUserDao::removeToken($cookieToken);
    }

    public function generateRememberMeToken() {
    	$token = null;
		if (isset($this->dao)) {
			$token = LookupRememberUserDao::createToken($this->dao->getId());
		}

		return $token;
    }

    public function generateActivationToken() {
    	$token = null;
    	if (isset($this->dao)) {
    		$activationToken = new ActivationTokenDao();
    		$activationToken->setUserId($this->dao->getId());
    		$activationToken->save();

    		$token = $activationToken->getActivationToken();
    	}

    	return $token;
    }

    public function activate($token) {
    	$validToken = ActivationTokenDao::tokenExist($this->dao->getId(), $token);
    	if ($validToken) {
    		$this->dao->setIsActive('Y');
    		$validToken = $this->dao->save();
    		ActivationTokenDao::consumeToken($this->dao->getId(), $token);
    	}

    	return $validToken;
    }

// =============================================================================== override

	public function getId() {
		if (isset($this->dao)) {
			return $this->dao->getId();
		} else {
			return 0;
		}
	}
	protected function init() {
		$input = $this->getInput();
		if (is_numeric($input)) {
			$this->dao = new UserDao($input);
		} else {
			$this->dao = $this->getInput();
		}
	}
    public function persist() {
		if (isset($this->dao)) {
    		$this->dao->save();
		}
    }

// =============================================================================== accesser
    
    public function getEmail() {
        return $this->dao->getEmail();
    }
    public function setPassword($password) {
        $this->dao->setPassword($password);
    }
    public function setName($name) {
        $this->dao->setName($name);
    }
    public function getName() {
        return $this->dao->getName();
    }
    public function setProfilePic($profilePic) {
        $this->dao->setProfilePic($profilePic);
    }
    public function getProfilePic() {
        return $this->dao->getProfilePic();
    }
    public function setDescription($description) {
        $this->dao->setDescription($description);
    }
    public function getDescription() {
        return $this->dao->getDescription();
    }
    public function getLastLogin() {
        return $this->dao->getLastLogin();
    }
}
?>