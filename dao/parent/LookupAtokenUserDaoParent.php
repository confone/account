<?php
abstract class LookupAtokenUserDaoParent extends AccountDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['access_token'] = '';
        $this->var['user_id'] = '';

        $this->update['id'] = false;
        $this->update['access_token'] = false;
        $this->update['user_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setAccessToken($accessToken) {
        $this->var['access_token'] = $access_token;
        $this->update['access_token'] = true;
    }
    public function getAccessToken() {
        return $this->var['access_token'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $user_id;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

// ======================================================================================== override

    protected function getTableName() {
        return 'lookup_atoken_user';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'account_lookup_user';
    }

    abstract protected function isShardBaseObject();
}
?>