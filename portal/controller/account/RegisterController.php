<?php
class RegisterController extends ViewController {

	protected function control() {

		$this->render( array(
			'view' => 'account/register.php'
		));
	}
}
?>