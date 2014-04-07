<?php
abstract class ApplicationDaoParent extends AccountDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['developer_id'] = '';
        $this->var['pub_key'] = '';
        $this->var['pri_key'] = '';

        $this->update['id'] = false;
        $this->update['developer_id'] = false;
        $this->update['pub_key'] = false;
        $this->update['pri_key'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setDeveloperId($developerId) {
        $this->var['developer_id'] = $developer_id;
        $this->update['developer_id'] = true;
    }
    public function getDeveloperId() {
        return $this->var['developer_id'];
    }

    public function setPubKey($pubKey) {
        $this->var['pub_key'] = $pub_key;
        $this->update['pub_key'] = true;
    }
    public function getPubKey() {
        return $this->var['pub_key'];
    }

    public function setPriKey($priKey) {
        $this->var['pri_key'] = $pri_key;
        $this->update['pri_key'] = true;
    }
    public function getPriKey() {
        return $this->var['pri_key'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'application';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'account_developer';
    }
}
?>