<?php
abstract class ResetTokenDaoParent extends AccountDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';
        $this->var['reset_token'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['reset_token'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setResetToken($resetToken) {
        $this->var['reset_token'] = $resetToken;
        $this->update['reset_token'] = true;
    }
    public function getResetToken() {
        return $this->var['reset_token'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'reset_token';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'account_user';
    }
}
?>