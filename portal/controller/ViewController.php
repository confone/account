<?php
abstract class ViewController {

	protected function render($view) {
		if (file_exists('view/'.$view)) {
			include 'view/'.$view;
		} else {
			throw new Exception('View does not exist.');
		}
	}

	public function execute() {
		$this->control();
	}

	abstract protected function control();
}
?>