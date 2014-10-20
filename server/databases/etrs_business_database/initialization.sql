DELIMITER ; -- Sets the statement delimiter

-- Drops the database
DROP DATABASE IF EXISTS etrs_business_database;

-- Creates the database
CREATE DATABASE IF NOT EXISTS etrs_business_database
CHARACTER SET utf8;

-- Sets the database as the current one
USE etrs_business_database
