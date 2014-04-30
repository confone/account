<?php
class ActivationController extends ViewController {

	protected function control() {

		$this->render( array(
			'title' => 'Account Activation | Confone',
			'view' => 'account/activation.php'
		));
	}
}
?>