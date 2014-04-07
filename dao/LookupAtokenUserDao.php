<?php
class LookupAtokenUserDao extends LookupAtokenUserDaoParent {

// ============================================ override functions ==================================================


// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->getAccessToken());
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>