<?php
class UserDao extends UserDaoParent {

// ================================================ public function =================================================

	public static function getUserByEmailAndPassword($email, $passwd) {
		$userId = LookupEmailUserDao::getUserIdByEmail($email);

		if ($userId==0) { return false; }

		$user = new UserDao($userId);

		if ($user->getPassword()!=md5($passwd)) {
			$user = null;
		} else {
			$date = gmdate('Y-m-d H:i:s');
			$user->setLastLogin($date);
			$user->save();
		}

		return $user;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = gmdate('Y-m-d H:i:s');
		$this->setLastLogin($date);
		$this->setIsActive('N');

		$lookup = new LookupEmailUserDao();
		$lookup->setUserId($this->getId());
		$lookup->setEmail($this->getEmail());
		$lookup->save();
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>