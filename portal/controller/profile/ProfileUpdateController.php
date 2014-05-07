<?php
class ProfileUpdateController extends ViewController {

	protected function control() {
		global $_ASESSION;

		$name = param('name');
		$description = param('description');

		if ($this->validateInput($name, $description)) {
			$this->redirect('/profile');
		}

		$userId = $_ASESSION->getUserId();

		if (!$userId) {
			$this->redirect('/login');
		}

		$user = new User($userId);
		$user->setName($name);
		$user->setDescription($description);
		$user->persist();

		$this->redirect('/profile');
	}

	private function validateInput($name, $description) {
		return !isset($name) || 
			   !isset($description);
	}
}
?>