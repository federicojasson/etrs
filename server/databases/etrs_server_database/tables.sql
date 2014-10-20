DELIMITER ; -- Sets the statement delimiter

--
-- Table: sessions.
--
-- TODO
--
CREATE TABLE IF NOT EXISTS sessions (
	id VARCHAR(40),
	
	creation_datetime DATETIME NOT NULL,
	data BLOB NOT NULL,
	last_access_datetime DATETIME NOT NULL,

	PRIMARY KEY(id),
	INDEX(creation_datetime),
	INDEX(last_access_datetime)
) ENGINE = InnoDB;

GRANT SELECT
ON etrs_server_database.sessions
TO 'etrs_system'@'localhost';
