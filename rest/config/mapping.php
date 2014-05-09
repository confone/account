<?php
register('GET', '/display/profile/:image', new GetProfileImageHandler(), null);
register('GET', '/profile/:accountid',     new GetProfileHandler(),      null);
?>
