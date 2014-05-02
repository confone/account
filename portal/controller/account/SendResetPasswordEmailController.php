<?php
class SendResetPasswordEmailController extends ViewController {

	protected function control() {

		$response = array();
		$response['status'] = 'success';
		$this->response($response);
	}
}