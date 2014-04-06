CREATE TABLE {$dbName}.user_email
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	email VARCHAR(61),
	user_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_user_email_email_index ON {$dbName}.user_email (email(60));
CREATE INDEX {$dbName}_user_email_user_id_index ON {$dbName}.user_email (user_id);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';

INSERT INTO {$dbName}.user_email(email, user_id) VALUES('admin@confone.com', 1);