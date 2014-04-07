<?php
abstract class TokenDaoParent extends AccountDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';
        $this->var['application_id'] = '';
        $this->var['access_token'] = '';
        $this->var['refresh_token'] = '';
        $this->var['expires_in'] = '';
        $this->var['scope'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['application_id'] = false;
        $this->update['access_token'] = false;
        $this->update['refresh_token'] = false;
        $this->update['expires_in'] = false;
        $this->update['scope'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $user_id;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setApplicationId($applicationId) {
        $this->var['application_id'] = $application_id;
        $this->update['application_id'] = true;
    }
    public function getApplicationId() {
        return $this->var['application_id'];
    }

    public function setAccessToken($accessToken) {
        $this->var['access_token'] = $access_token;
        $this->update['access_token'] = true;
    }
    public function getAccessToken() {
        return $this->var['access_token'];
    }

    public function setRefreshToken($refreshToken) {
        $this->var['refresh_token'] = $refresh_token;
        $this->update['refresh_token'] = true;
    }
    public function getRefreshToken() {
        return $this->var['refresh_token'];
    }

    public function setExpiresIn($expiresIn) {
        $this->var['expires_in'] = $expires_in;
        $this->update['expires_in'] = true;
    }
    public function getExpiresIn() {
        return $this->var['expires_in'];
    }

    public function setScope($scope) {
        $this->var['scope'] = $scope;
        $this->update['scope'] = true;
    }
    public function getScope() {
        return $this->var['scope'];
    }

// ======================================================================================== override

    protected function getTableName() {
        return 'token';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'account_user';
    }

    abstract protected function isShardBaseObject();
}
?>