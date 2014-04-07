<?php
class LookupEmailUserDao extends LookupEmailUserDaoParent {

// ============================================== public functions ==================================================

	public static function getUserIdByEmail($email) {
		$lookup = new LookupEmailUserDao();
		$lookup->setServerAddress($email);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('user_id')
					   ->where('email', $email)
					   ->find();

		if ($res) {
			return $res['user_id'];
		} else {
			return 0;
		}
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->getEmail());
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>