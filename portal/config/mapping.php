<?php
register('/login',            new LoginController());
register('/register',         new RegisterController());
register('/forget', 		  new ForgetPasswordController());
register('/logout',           new LogoutController());
register('/profile',          new ProfileDetailController());
register('/activation',       new ActivationController());
register('/reset-password',   new ResetPasswordController());
register('/pending', 		  new PendingController());
register('/email/activation', new SendActivationEmailController());
register('/email/reset',	  new SendResetPasswordEmailController());

register('/external/profile.js', new ExternalHeaderController());
?>
