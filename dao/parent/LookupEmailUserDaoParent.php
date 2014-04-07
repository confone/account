<?php
abstract class LookupEmailUserDaoParent extends AccountDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['email'] = '';
        $this->var['user_id'] = '';

        $this->update['id'] = false;
        $this->update['email'] = false;
        $this->update['user_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setEmail($email) {
        $this->var['email'] = $email;
        $this->update['email'] = true;
    }
    public function getEmail() {
        return $this->var['email'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $user_id;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_email_user';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'account_lookup_user';
    }
}
?>