<?php
class UserDao extends UserDaoParent {

// ================================================ public function =================================================

	public static function authenticate($email, $passwd) {
		$userId = LookupUserDao::getUserIdByEmail($email);

		if ($userId==0) { return false; }

		$user = new UserDao($userId);

		if ($user->getPassword()!=md5($passwd)) {
			$userId = 0;
		}

		return $userId;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = gmdate('Y-m-d H:i:s');
		$this->setLastLogin($date);

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