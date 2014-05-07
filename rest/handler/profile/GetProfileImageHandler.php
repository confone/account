<?php
class GetProfileImageHandler extends Handler {

	protected function handle($params) {
		$image = $params['image'];

		global $profile_image_dir;

    	header('Content-Type: image/png');
    	header('Cache-Control: max-age=2592000');
		readfile($profile_image_dir.$image);
	}
}
?>