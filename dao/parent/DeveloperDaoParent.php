<?php
abstract class DeveloperDaoParent extends AccountDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
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

// ======================================================================================== override

    public function getTableName() {
        return 'developer';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'account_developer';
    }
}
?>