<?php
class ProfileDetailController extends ViewController {

	protected function control() {

		$this->render(array(
			'view' => 'profile/detail.php'
		));
	}
}
?>