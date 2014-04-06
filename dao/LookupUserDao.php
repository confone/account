<?php
class LookupUserDao extends AccountDao {

	const USERID = 'user_id';
	const EMAIL = 'email';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'account_lookup_user';
	const TABLE = 'user_email';

// ============================================ override functions ==================================================

	public static function getUserIdByEmail($email) {
		$lookup = new LookupUserDao();
		$lookup->setServerAddress($email);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select(LookupUserDao::USERID, LookupUserDao::TABLE)
					   ->where(LookupUserDao::EMAIL, $email)
					   ->find();

		if ($res) {
			return $res[LookupUserDao::USERID];
		} else {
			return 0;
		}
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupUserDao::IDCOLUMN] = 0;
		$this->var[LookupUserDao::EMAIL] = 0;
		$this->var[LookupUserDao::USERID] = 0;
	}

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->var[LookupUserDao::EMAIL]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupUserDao::SHARDDOMAIN;
	}

	public function getTableName() {
		return LookupUserDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupUserDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>