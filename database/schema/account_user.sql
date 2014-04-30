CREATE TABLE {$dbName}.user
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	email VARCHAR(61),
	password VARCHAR(41),
	name VARCHAR(128),
	profile_pic VARCHAR(61),
	description VARCHAR(256),
	is_active VARCHAR(2),
	last_login DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;


CREATE TABLE {$dbName}.access_token
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	application_id INT(10) UNSIGNED,
	access_token VARCHAR(65),
	refresh_token VARCHAR(129),
	expires_in INT(10) UNSIGNED,
	scope VARCHAR(128),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;


CREATE TABLE {$dbName}.activation_token
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	activation_token VARCHAR(65),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_activation_token_user_id_index ON {$dbName}.activation_token (user_id);
CREATE INDEX {$dbName}_activation_token_token_index ON {$dbName}.activation_token (activation_token(64));


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';

INSERT INTO {$dbName}.user(email, password, name, profile_pic, description, last_login)
VALUES ('admin@confone.com', MD5('password'), 'Peng Shen', '', '', NOW());
