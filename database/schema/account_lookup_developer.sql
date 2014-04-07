CREATE TABLE {$dbName}.lookup_pubkey_dev
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	pub_key VARCHAR(65),
	developer_id INT(10) UNSIGNED,
	application_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_lookup_pubkey_dev_pub_key_index ON {$dbName}.lookup_pubkey_dev (pub_key(64));
CREATE INDEX {$dbName}_lookup_pubkey_dev_developer_id_index ON {$dbName}.lookup_pubkey_dev (developer_id);
CREATE INDEX {$dbName}_lookup_pubkey_dev_application_id_index ON {$dbName}.lookup_pubkey_dev (application_id);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';