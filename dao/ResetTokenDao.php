<?php
class ResetTokenDao extends ResetTokenDaoParent {

// ============================================ override functions ==================================================

	public static function tokenExist($userId, $resetToken) {
		$token = new ResetTokenDao();
		$token->setServerAddress($userId);

		$builder = new QueryBuilder($token);
		$res = $builder->select('COUNT(*) as count')
					   ->where('user_id', $userId)
					   ->where('reset_token', $resetToken)
					   ->find();

		return $res['count']>0;
	}

	public static function consumeToken($userId, $resetToken) {
		$token = new ResetTokenDao();
		$token->setServerAddress($userId);

		$builder = new QueryBuilder($token);
		$res = $builder->delete()
					   ->where('user_id', $userId)
					   ->where('reset_token', $resetToken)
					   ->query();
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getUserId();
		$this->setShardId($sequence);
		$this->setResetToken(Utility::generateResetPasswordToken());
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>