<?php
abstract class ActivationTokenDaoParent extends AccountDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';
        $this->var['activation_token'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['activation_token'] = false;
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

    public function setActivationToken($activationToken) {
        $this->var['activation_token'] = $activationToken;
        $this->update['activation_token'] = true;
    }
    public function getActivationToken() {
        return $this->var['activation_token'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'activation_token';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'account_user';
    }
}
?>