<?php
abstract class LookupRememberUserDaoParent extends AccountDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['cookie_token'] = '';
        $this->var['user_id'] = '';
        $this->var['expires_in'] = '';

        $this->update['id'] = false;
        $this->update['cookie_token'] = false;
        $this->update['user_id'] = false;
        $this->update['expires_in'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setCookieToken($cookieToken) {
        $this->var['cookie_token'] = $cookieToken;
        $this->update['cookie_token'] = true;
    }
    public function getCookieToken() {
        return $this->var['cookie_token'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setExpiresIn($expiresIn) {
        $this->var['expires_in'] = $expiresIn;
        $this->update['expires_in'] = true;
    }
    public function getExpiresIn() {
        return $this->var['expires_in'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_remember_user';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'account_lookup_user';
    }
}
?>