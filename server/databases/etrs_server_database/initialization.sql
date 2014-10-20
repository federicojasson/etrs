DELIMITER ; -- Sets the statement delimiter

-- Drops the database
DROP DATABASE IF EXISTS etrs_server_database;

-- Creates the database
CREATE DATABASE IF NOT EXISTS etrs_server_database
CHARACTER SET utf8;

-- Sets the database as the current one
USE etrs_server_database
