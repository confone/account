<?php
class ProfileDetailController extends ViewController {

	protected function control() {
		global $_ASESSION;

		$userId = $_ASESSION->getUserId();

		if (!$userId) {
			$this->redirect('/login');
		}

		$user = new User($userId);

		$this->render(array(
			'view' => 'profile/detail.php',
			'user' => $user
		));
	}
}
?>