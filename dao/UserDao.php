<?php
class UserDao extends UserDaoParent {

// ================================================ public function =================================================


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