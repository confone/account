CREATE TABLE {$dbName}.client
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	app_key VARCHAR(33) NOT NULL,
	name VARCHAR(41) NOT NULL,
	create_time DATETIME NOT NULL,
	modified_time DATETIME NOT NULL,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_client_app_key_index ON {$dbName}.client (app_key(32));

INSERT INTO {$dbName}.client (app_key, name, create_time, modified_time) VALUES ('31949DD805AACCE0E54F82769B5655D5', 'content', NOW(), NOW());
INSERT INTO {$dbName}.client (app_key, name, create_time, modified_time) VALUES ('9D0E7CE8711F6F1CF87704557828A16E', 'security', NOW(), NOW());
INSERT INTO {$dbName}.client (app_key, name, create_time, modified_time) VALUES ('96C60742E569BF6AE8D75C639B974B99', 'www', NOW(), NOW());


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';
