DELIMITER ; -- Sets the statement delimiter

-- Drops the database
DROP DATABASE IF EXISTS etrs_server_database;


-- Drops the database users
-- Before, it creates them, to avoid errors if they don't exist

GRANT USAGE ON *.* TO
'etrs_server_user'@'localhost';

DROP USER
'etrs_server_user'@'localhost';
