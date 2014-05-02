<?php
class ActivationTokenDao extends ActivationTokenDaoParent {

// ============================================ override functions ==================================================

	public static function tokenExist($userId, $activationToken) {
		$token = new ActivationTokenDao();
		$token->setServerAddress($userId);

		$builder = new QueryBuilder($token);
		$res = $builder->select('COUNT(*) as count')
					   ->where('user_id', $userId)
					   ->where('activation_token', $activationToken)
					   ->find();

		return $res['count']>0;
	}

	public static function consumeToken($userId, $activationToken) {
		$token = new ActivationTokenDao();
		$token->setServerAddress($userId);

		$builder = new QueryBuilder($token);
		$res = $builder->delete()
					   ->where('user_id', $userId)
					   ->where('activation_token', $activationToken)
					   ->query();
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getUserId();
		$this->setShardId($sequence);
		$this->setActivationToken(Utility::generateActivationToken());
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>