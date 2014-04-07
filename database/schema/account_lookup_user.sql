CREATE TABLE {$dbName}.lookup_email_user
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	email VARCHAR(61),
	user_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_lookup_email_user_email_index ON {$dbName}.lookup_email_user (email(60));
CREATE INDEX {$dbName}_lookup_email_user_user_id_index ON {$dbName}.lookup_email_user (user_id);


CREATE TABLE {$dbName}.lookup_atoken_user
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	access_token VARCHAR(65),
	user_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_lookup_atoken_user_access_token_index ON {$dbName}.lookup_atoken_user (access_token(64));
CREATE INDEX {$dbName}_lookup_atoken_user_user_id_id_index ON {$dbName}.lookup_atoken_user (user_id);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';

INSERT INTO {$dbName}.lookup_email_user(email, user_id) VALUES('admin@confone.com', 1);