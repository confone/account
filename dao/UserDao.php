<?php
class UserDao extends AccountDao {

	const EMAIL = 'email';
	const PASSWORD = 'password';
	const NAME = 'name';
	const PROFILEPIC = 'profile_pic';
	const DESCRIPTION = 'description';
	const LASTLOGIN = 'last_login';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'account_user';
	const TABLE = 'user';


// =============================================== public function =================================================

	public static function authenticate($email, $passwd) {
		$userId = LookupUserDao::getUserIdByEmail($email);

		if ($userId==0) { return false; }

		$user = new UserDao($userId);

		if ($user->var[UserDao::PASSWORD]!=md5($passwd)) {
			$userId = 0;
		}

		return $userId;
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[UserDao::IDCOLUMN] = 0;
		$this->var[UserDao::EMAIL] = 0;
		$this->var[UserDao::PASSWORD] = '';
		$this->var[UserDao::NAME] = '';
		$this->var[UserDao::PROFILEPIC] = '';
		$this->var[UserDao::DESCRIPTION] = '';

		$date = gmdate('Y-m-d H:i:s');
		$this->var[UserDao::LASTLOGIN] = $date;
	}

	protected function beforeInsert() {
		$lookup = new LookupUserDao();
		$lookup->var[LookupUserDao::USERID] = $this->var[UserDao::IDCOLUMN];
		$lookup->var[LookupUserDao::EMAIL] = $this->var[UserDao::EMAIL];
		$lookup->save();
	}

	public function getShardDomain() {
		return UserDao::SHARDDOMAIN;
	}

	public function getTableName() {
		return UserDao::TABLE;
	}

	public function getIdColumnName() {
		return UserDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>