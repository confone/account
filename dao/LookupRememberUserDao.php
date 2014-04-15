<?php
class LookupRememberUserDao extends LookupRememberUserDaoParent {

// ================================================ public function =================================================

	public static function createRememberDao($userId) {
		$digits = strlen((string)$userId) + 1;

		do {
			$date = date('Y-m-d H:i:s'.$userId.rand(0, 1000000));
			$token = md5($date);
			$token = substr($token, 0, -1*$digits).'-'.$userId;
		} while (self::tokenExist($token));

		$now = strtotime('now');

		$rememberUserDao = new LookupRememberUserDao();
		$rememberUserDao->setCookieToken($token);
		$rememberUserDao->setUserId($userId);
		$rememberUserDao->setExpiresIn($now);

		if ($rememberUserDao->save()) {
			return $token;
		} else {
			return null;
		}
	}

	public static function getUserIdByCookieToken($cookieToken) {
		$lookup = new LookupRememberUserDao();
		$lookup->setServerAddress(Utility::hashString($cookieToken));

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('user_id')
					   ->where('cookie_token', $cookieToken)
					   ->find();

		if ($res) {
			return $res['user_id'];
		} else {
			return 0;
		}
	}

	public static function tokenExist($cookieToken) {
		$lookup = new LookupRememberUserDao();
		$lookup->setServerAddress(Utility::hashString($cookieToken));

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('COUNT(*) as count')
					   ->where('cookie_token', $cookieToken)
					   ->find();

		return $res['count']>0;
	}

	public static function removeToken($cookieToken) {
		$lookup = new LookupRememberUserDao();
		$lookup->setServerAddress(Utility::hashString($cookieToken));

		$builder = new QueryBuilder($lookup);
		$builder->delete()->where('cookie_token', $cookieToken)->query();
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->getCookieToken());
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}