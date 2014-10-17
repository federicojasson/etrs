DELIMITER ; -- Sets the statement delimiter

-- Drops the database
DROP DATABASE IF EXISTS etrs_database;


-- Drops the database users
-- Before, it creates them, to avoid errors if they don't exist

GRANT USAGE ON *.* TO
'etrs_doctor'@'localhost',
'etrs_operator'@'localhost',
'etrs_researcher'@'localhost';

DROP USER
'etrs_doctor'@'localhost',
'etrs_operator'@'localhost',
'etrs_researcher'@'localhost';
