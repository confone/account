<?php
register('/login',                new LoginController());
register('/register',             new RegisterController());
register('/forget',               new ForgetPasswordController());
register('/logout',               new LogoutController());
register('/activation',           new ActivationController());
register('/reset-password',       new ResetPasswordController());
register('/pending',              new PendingController());
register('/reset-email',          new ForgetEmailController());
register('/email/reset-password', new EmailResetPasswordController());
register('/email/activation',     new EmailActivationController());

register('/external/profile.js',  new ExternalHeaderController());

register('/profile',              new ProfileDetailController());
register('/profile/update',       new ProfileUpdateController());
?>
