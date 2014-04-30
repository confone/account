<?php
abstract class UserDaoParent extends AccountDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['email'] = '';
        $this->var['password'] = '';
        $this->var['name'] = '';
        $this->var['profile_pic'] = '';
        $this->var['description'] = '';
        $this->var['is_active'] = '';
        $this->var['last_login'] = '';

        $this->update['id'] = false;
        $this->update['email'] = false;
        $this->update['password'] = false;
        $this->update['name'] = false;
        $this->update['profile_pic'] = false;
        $this->update['description'] = false;
        $this->update['is_active'] = false;
        $this->update['last_login'] = false;
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

    public function setPassword($password) {
        $this->var['password'] = $password;
        $this->update['password'] = true;
    }
    public function getPassword() {
        return $this->var['password'];
    }

    public function setName($name) {
        $this->var['name'] = $name;
        $this->update['name'] = true;
    }
    public function getName() {
        return $this->var['name'];
    }

    public function setProfilePic($profilePic) {
        $this->var['profile_pic'] = $profilePic;
        $this->update['profile_pic'] = true;
    }
    public function getProfilePic() {
        return $this->var['profile_pic'];
    }

    public function setDescription($description) {
        $this->var['description'] = $description;
        $this->update['description'] = true;
    }
    public function getDescription() {
        return $this->var['description'];
    }

    public function setIsActive($isActive) {
        $this->var['is_active'] = $isActive;
        $this->update['is_active'] = true;
    }
    public function getIsActive() {
        return $this->var['is_active'];
    }

    public function setLastLogin($lastLogin) {
        $this->var['last_login'] = $lastLogin;
        $this->update['last_login'] = true;
    }
    public function getLastLogin() {
        return $this->var['last_login'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'user';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'account_user';
    }
}
?>