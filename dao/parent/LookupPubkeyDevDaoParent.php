<?php
abstract class LookupPubkeyDevDaoParent extends AccountDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['pub_key'] = '';
        $this->var['developer_id'] = '';
        $this->var['application_id'] = '';

        $this->update['id'] = false;
        $this->update['pub_key'] = false;
        $this->update['developer_id'] = false;
        $this->update['application_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setPubKey($pubKey) {
        $this->var['pub_key'] = $pub_key;
        $this->update['pub_key'] = true;
    }
    public function getPubKey() {
        return $this->var['pub_key'];
    }

    public function setDeveloperId($developerId) {
        $this->var['developer_id'] = $developer_id;
        $this->update['developer_id'] = true;
    }
    public function getDeveloperId() {
        return $this->var['developer_id'];
    }

    public function setApplicationId($applicationId) {
        $this->var['application_id'] = $application_id;
        $this->update['application_id'] = true;
    }
    public function getApplicationId() {
        return $this->var['application_id'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_pubkey_dev';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'account_lookup_developer';
    }
}
?>