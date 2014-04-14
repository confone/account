<?php
register('/login',          new LoginController());
register('/register',       new RegisterController());
register('/reset-password', new ForgetPasswordController());
register('/logout',         new LogoutController());
register('/profile',        new ProfileDetailController());

register('/external/profile.js', new ExternalHeaderController());
?>
