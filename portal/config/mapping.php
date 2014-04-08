<?php
register('/login',    new LoginController());
register('/register', new RegisterController());
register('/logout',   new LogoutController());
register('/profile',  new ProfileDetailController());
?>
