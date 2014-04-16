CREATE TABLE {$dbName}.user
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	email VARCHAR(61),
	password VARCHAR(41),
	name VARCHAR(128),
	profile_pic VARCHAR(61),
	description VARCHAR(256),
	last_login DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;


CREATE TABLE {$dbName}.token
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


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';

INSERT INTO {$dbName}.user(email, password, name, profile_pic, description, last_login)
VALUES ('admin@confone.com', MD5('password'), 'Peng Shen', '', '', NOW());
