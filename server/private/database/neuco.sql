-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema neuco
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema neuco
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `neuco` DEFAULT CHARACTER SET utf8 ;
USE `neuco` ;

-- -----------------------------------------------------
-- Table `neuco`.`logs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`logs` ;

CREATE TABLE IF NOT EXISTS `neuco`.`logs` (
  `id` BINARY(16) NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `level` SMALLINT(5) UNSIGNED NOT NULL,
  `message` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT INDEX `logs.full_text` (`message` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`sessions` ;

CREATE TABLE IF NOT EXISTS `neuco`.`sessions` (
  `id` BINARY(32) NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_access_date_time` DATETIME NOT NULL,
  `data` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`users` ;

CREATE TABLE IF NOT EXISTS `neuco`.`users` (
  `id` VARBINARY(32) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `role` BINARY(2) NOT NULL,
  `email_address` VARCHAR(254) NOT NULL,
  `password_hash` BINARY(64) NOT NULL,
  `salt` BINARY(64) NOT NULL,
  `key_stretching_iterations` INT(10) UNSIGNED NOT NULL,
  `first_name` VARCHAR(48) NOT NULL,
  `last_name` VARCHAR(48) NOT NULL,
  `gender` BINARY(1) NOT NULL,
  `inviter` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `users.inviter` (`inviter` ASC),
  FULLTEXT INDEX `users.full_text` (`email_address` ASC, `first_name` ASC, `last_name` ASC),
  CONSTRAINT `users.inviter`
    FOREIGN KEY (`inviter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`medicines`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`medicines` ;

CREATE TABLE IF NOT EXISTS `neuco`.`medicines` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `medicines.creator` (`creator` ASC),
  INDEX `medicines.last_editor` (`last_editor` ASC),
  INDEX `medicines.deleter` (`deleter` ASC),
  FULLTEXT INDEX `medicines.full_text` (`name` ASC),
  CONSTRAINT `medicines.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `medicines.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `medicines.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`password_reset_permissions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`password_reset_permissions` ;

CREATE TABLE IF NOT EXISTS `neuco`.`password_reset_permissions` (
  `id` BINARY(16) NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `password_hash` BINARY(64) NOT NULL,
  `salt` BINARY(64) NOT NULL,
  `key_stretching_iterations` INT(10) UNSIGNED NOT NULL,
  `user` VARBINARY(32) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `password_reset_permissions.user` (`user` ASC),
  CONSTRAINT `password_reset_permissions.user`
    FOREIGN KEY (`user`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`sign_up_permissions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`sign_up_permissions` ;

CREATE TABLE IF NOT EXISTS `neuco`.`sign_up_permissions` (
  `id` BINARY(16) NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `password_hash` BINARY(64) NOT NULL,
  `salt` BINARY(64) NOT NULL,
  `key_stretching_iterations` INT(10) UNSIGNED NOT NULL,
  `user_role` BINARY(2) NOT NULL,
  `email_address` VARCHAR(254) NOT NULL,
  `creator` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `sign_up_permissions.creator` (`creator` ASC),
  CONSTRAINT `sign_up_permissions.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = '	';


-- -----------------------------------------------------
-- Table `neuco`.`treatments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`treatments` ;

CREATE TABLE IF NOT EXISTS `neuco`.`treatments` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `treatments.creator` (`creator` ASC),
  INDEX `treatments.last_editor` (`last_editor` ASC),
  INDEX `treatments.deleter` (`deleter` ASC),
  FULLTEXT INDEX `treatments.full_text` (`name` ASC),
  CONSTRAINT `treatments.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `treatments.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `treatments.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`diagnoses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`diagnoses` ;

CREATE TABLE IF NOT EXISTS `neuco`.`diagnoses` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `diagnoses.creator` (`creator` ASC),
  INDEX `diagnoses.last_editor` (`last_editor` ASC),
  INDEX `diagnoses.deleter` (`deleter` ASC),
  FULLTEXT INDEX `diagnoses.full_text` (`name` ASC),
  CONSTRAINT `diagnoses.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `diagnoses.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `diagnoses.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`clinical_impressions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`clinical_impressions` ;

CREATE TABLE IF NOT EXISTS `neuco`.`clinical_impressions` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `clinical_impressions.creator` (`creator` ASC),
  INDEX `clinical_impressions.last_editor` (`last_editor` ASC),
  INDEX `clinical_impressions.deleter` (`deleter` ASC),
  FULLTEXT INDEX `clinical_impressions.full_text` (`name` ASC),
  CONSTRAINT `clinical_impressions.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `clinical_impressions.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `clinical_impressions.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`medical_antecedents`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`medical_antecedents` ;

CREATE TABLE IF NOT EXISTS `neuco`.`medical_antecedents` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `medical_antecedents.creator` (`creator` ASC),
  INDEX `medical_antecedents.last_editor` (`last_editor` ASC),
  INDEX `medical_antecedents.deleter` (`deleter` ASC),
  FULLTEXT INDEX `medical_antecedents.full_text` (`name` ASC),
  CONSTRAINT `medical_antecedents.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `medical_antecedents.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `medical_antecedents.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`laboratory_tests`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`laboratory_tests` ;

CREATE TABLE IF NOT EXISTS `neuco`.`laboratory_tests` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `data_type_definition` VARCHAR(1024) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `laboratory_tests.creator` (`creator` ASC),
  INDEX `laboratory_tests.last_editor` (`last_editor` ASC),
  INDEX `laboratory_tests.deleter` (`deleter` ASC),
  FULLTEXT INDEX `laboratory_tests.full_text` (`name` ASC),
  CONSTRAINT `laboratory_tests.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `laboratory_tests.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `laboratory_tests.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`imaging_tests`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`imaging_tests` ;

CREATE TABLE IF NOT EXISTS `neuco`.`imaging_tests` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `data_type_definition` VARCHAR(1024) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `imaging_tests.creator` (`creator` ASC),
  INDEX `imaging_tests.last_editor` (`last_editor` ASC),
  INDEX `imaging_tests.deleter` (`deleter` ASC),
  FULLTEXT INDEX `imaging_tests.full_text` (`name` ASC),
  CONSTRAINT `imaging_tests.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `imaging_tests.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `imaging_tests.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`cognitive_tests`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`cognitive_tests` ;

CREATE TABLE IF NOT EXISTS `neuco`.`cognitive_tests` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `data_type_definition` VARCHAR(1024) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `cognitive_tests.creator` (`creator` ASC),
  INDEX `cognitive_tests.last_editor` (`last_editor` ASC),
  INDEX `cognitive_tests.deleter` (`deleter` ASC),
  FULLTEXT INDEX `cognitive_tests.full_text` (`name` ASC),
  CONSTRAINT `cognitive_tests.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `cognitive_tests.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `cognitive_tests.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`patients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`patients` ;

CREATE TABLE IF NOT EXISTS `neuco`.`patients` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `first_name` VARCHAR(48) NOT NULL,
  `last_name` VARCHAR(48) NOT NULL,
  `gender` BINARY(1) NOT NULL,
  `birth_date` DATE NOT NULL,
  `years_of_education` SMALLINT(5) UNSIGNED NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `patients.creator` (`creator` ASC),
  INDEX `patients.last_editor` (`last_editor` ASC),
  INDEX `patients.deleter` (`deleter` ASC),
  FULLTEXT INDEX `patients.full_text` (`first_name` ASC, `last_name` ASC),
  CONSTRAINT `patients.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `patients.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `patients.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`consultations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`consultations` ;

CREATE TABLE IF NOT EXISTS `neuco`.`consultations` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `date` DATE NOT NULL,
  `presenting_problem` TEXT NOT NULL,
  `comments` TEXT NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  `patient` BINARY(16) NOT NULL,
  `clinical_impression` BINARY(16) NULL,
  `diagnosis` BINARY(16) NULL,
  PRIMARY KEY (`id`),
  INDEX `consultations.creator` (`creator` ASC),
  INDEX `consultations.last_editor` (`last_editor` ASC),
  INDEX `consultations.deleter` (`deleter` ASC),
  INDEX `consultations.patient` (`patient` ASC),
  INDEX `consultations.clinical_impression` (`clinical_impression` ASC),
  INDEX `consultations.diagnosis` (`diagnosis` ASC),
  CONSTRAINT `consultations.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `consultations.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `consultations.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `consultations.patient`
    FOREIGN KEY (`patient`)
    REFERENCES `neuco`.`patients` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `consultations.clinical_impression`
    FOREIGN KEY (`clinical_impression`)
    REFERENCES `neuco`.`clinical_impressions` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `consultations.diagnosis`
    FOREIGN KEY (`diagnosis`)
    REFERENCES `neuco`.`diagnoses` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`laboratory_test_results`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`laboratory_test_results` ;

CREATE TABLE IF NOT EXISTS `neuco`.`laboratory_test_results` (
  `consultation` BINARY(16) NOT NULL,
  `laboratory_test` BINARY(16) NOT NULL,
  `value` VARBINARY(64) NOT NULL,
  PRIMARY KEY (`consultation`, `laboratory_test`),
  CONSTRAINT `laboratory_test_results.consultation`
    FOREIGN KEY (`consultation`)
    REFERENCES `neuco`.`consultations` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `laboratory_test_results.laboratory_test`
    FOREIGN KEY (`laboratory_test`)
    REFERENCES `neuco`.`laboratory_tests` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`imaging_test_results`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`imaging_test_results` ;

CREATE TABLE IF NOT EXISTS `neuco`.`imaging_test_results` (
  `consultation` BINARY(16) NOT NULL,
  `imaging_test` BINARY(16) NOT NULL,
  `value` VARBINARY(64) NOT NULL,
  PRIMARY KEY (`consultation`, `imaging_test`),
  CONSTRAINT `imaging_test_results.consultation`
    FOREIGN KEY (`consultation`)
    REFERENCES `neuco`.`consultations` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `imaging_test_results.imaging_test`
    FOREIGN KEY (`imaging_test`)
    REFERENCES `neuco`.`imaging_tests` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`cognitive_test_results`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`cognitive_test_results` ;

CREATE TABLE IF NOT EXISTS `neuco`.`cognitive_test_results` (
  `consultation` BINARY(16) NOT NULL,
  `cognitive_test` BINARY(16) NOT NULL,
  `value` VARBINARY(64) NOT NULL,
  PRIMARY KEY (`consultation`, `cognitive_test`),
  CONSTRAINT `cognitive_test_results.consultation`
    FOREIGN KEY (`consultation`)
    REFERENCES `neuco`.`consultations` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `cognitive_test_results.cognitive_test`
    FOREIGN KEY (`cognitive_test`)
    REFERENCES `neuco`.`cognitive_tests` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`consultations_treatments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`consultations_treatments` ;

CREATE TABLE IF NOT EXISTS `neuco`.`consultations_treatments` (
  `consultation` BINARY(16) NOT NULL,
  `treatment` BINARY(16) NOT NULL,
  PRIMARY KEY (`consultation`, `treatment`),
  CONSTRAINT `consultations_treatments.consultation`
    FOREIGN KEY (`consultation`)
    REFERENCES `neuco`.`consultations` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `consultations_treatments.treatment`
    FOREIGN KEY (`treatment`)
    REFERENCES `neuco`.`treatments` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`consultations_medicines`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`consultations_medicines` ;

CREATE TABLE IF NOT EXISTS `neuco`.`consultations_medicines` (
  `consultation` BINARY(16) NOT NULL,
  `medicine` BINARY(16) NOT NULL,
  PRIMARY KEY (`consultation`, `medicine`),
  CONSTRAINT `consultations_medicines.consultation`
    FOREIGN KEY (`consultation`)
    REFERENCES `neuco`.`consultations` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `consultations_medicines.medicine`
    FOREIGN KEY (`medicine`)
    REFERENCES `neuco`.`medicines` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`consultations_medical_antecedents`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`consultations_medical_antecedents` ;

CREATE TABLE IF NOT EXISTS `neuco`.`consultations_medical_antecedents` (
  `consultation` BINARY(16) NOT NULL,
  `medical_antecedent` BINARY(16) NOT NULL,
  PRIMARY KEY (`consultation`, `medical_antecedent`),
  CONSTRAINT `consultations_medical_antecedents.consultation`
    FOREIGN KEY (`consultation`)
    REFERENCES `neuco`.`consultations` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `consultations_medical_antecedents.medical_antecedent`
    FOREIGN KEY (`medical_antecedent`)
    REFERENCES `neuco`.`medical_antecedents` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`files` ;

CREATE TABLE IF NOT EXISTS `neuco`.`files` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `associated` TINYINT(1) NOT NULL,
  `hash` BINARY(16) NOT NULL,
  `name` VARCHAR(128) NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `files.creator` (`creator` ASC),
  INDEX `files.last_editor` (`last_editor` ASC),
  INDEX `files.deleter` (`deleter` ASC),
  CONSTRAINT `files.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `files.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `files.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`experiments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`experiments` ;

CREATE TABLE IF NOT EXISTS `neuco`.`experiments` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `deprecated` TINYINT(1) NOT NULL,
  `command_line` VARCHAR(512) NOT NULL,
  `output_name` VARCHAR(128) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  PRIMARY KEY (`id`),
  INDEX `experiments.creator` (`creator` ASC),
  INDEX `experiments.last_editor` (`last_editor` ASC),
  INDEX `experiments.deleter` (`deleter` ASC),
  FULLTEXT INDEX `experiments.full_text` (`name` ASC),
  CONSTRAINT `experiments.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `experiments.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `experiments.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`experiments_files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`experiments_files` ;

CREATE TABLE IF NOT EXISTS `neuco`.`experiments_files` (
  `experiment` BINARY(16) NOT NULL,
  `file` BINARY(16) NOT NULL,
  PRIMARY KEY (`experiment`, `file`),
  CONSTRAINT `experiments_files.experiment`
    FOREIGN KEY (`experiment`)
    REFERENCES `neuco`.`experiments` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `experiments_files.file`
    FOREIGN KEY (`file`)
    REFERENCES `neuco`.`files` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`studies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`studies` ;

CREATE TABLE IF NOT EXISTS `neuco`.`studies` (
  `id` BINARY(16) NOT NULL,
  `version` MEDIUMINT(8) UNSIGNED NOT NULL,
  `creation_date_time` DATETIME NOT NULL,
  `last_edition_date_time` DATETIME NULL,
  `deletion_date_time` DATETIME NULL,
  `deleted` TINYINT(1) NOT NULL,
  `state` SMALLINT(5) UNSIGNED NOT NULL,
  `comments` TEXT NOT NULL,
  `creator` VARBINARY(32) NULL,
  `last_editor` VARBINARY(32) NULL,
  `deleter` VARBINARY(32) NULL,
  `consultation` BINARY(16) NOT NULL,
  `experiment` BINARY(16) NOT NULL,
  `input` BINARY(16) NOT NULL,
  `output` BINARY(16) NULL,
  PRIMARY KEY (`id`),
  INDEX `studies.creator` (`creator` ASC),
  INDEX `studies.last_editor` (`last_editor` ASC),
  INDEX `studies.deleter` (`deleter` ASC),
  INDEX `studies.consultation` (`consultation` ASC),
  INDEX `studies.experiment` (`experiment` ASC),
  INDEX `studies.input` (`input` ASC),
  INDEX `studies.output` (`output` ASC),
  CONSTRAINT `studies.creator`
    FOREIGN KEY (`creator`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `studies.last_editor`
    FOREIGN KEY (`last_editor`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `studies.deleter`
    FOREIGN KEY (`deleter`)
    REFERENCES `neuco`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `studies.consultation`
    FOREIGN KEY (`consultation`)
    REFERENCES `neuco`.`consultations` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `studies.experiment`
    FOREIGN KEY (`experiment`)
    REFERENCES `neuco`.`experiments` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `studies.input`
    FOREIGN KEY (`input`)
    REFERENCES `neuco`.`files` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `studies.output`
    FOREIGN KEY (`output`)
    REFERENCES `neuco`.`files` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neuco`.`studies_files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neuco`.`studies_files` ;

CREATE TABLE IF NOT EXISTS `neuco`.`studies_files` (
  `study` BINARY(16) NOT NULL,
  `file` BINARY(16) NOT NULL,
  PRIMARY KEY (`study`, `file`),
  CONSTRAINT `studies_files.study`
    FOREIGN KEY (`study`)
    REFERENCES `neuco`.`studies` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `studies_files.file`
    FOREIGN KEY (`file`)
    REFERENCES `neuco`.`files` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

SET SQL_MODE = '';
GRANT USAGE ON *.* TO neuco_admin@localhost;
 DROP USER neuco_admin@localhost;
SET SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
CREATE USER 'neuco_admin'@'localhost' IDENTIFIED BY 'neuco_admin';

GRANT ALL ON neuco.* TO 'neuco_admin'@'localhost';
SET SQL_MODE = '';
GRANT USAGE ON *.* TO neuco_server@localhost;
 DROP USER neuco_server@localhost;
SET SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
CREATE USER 'neuco_server'@'localhost' IDENTIFIED BY 'neuco_server';

GRANT DELETE, INSERT, SELECT, UPDATE ON TABLE neuco.* TO 'neuco_server'@'localhost';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
-- begin attached script 'initial_data'
-- Selects the database
USE neuco;

-- Inserts a default user
-- Password: admin
INSERT INTO users (
	id,
	version,
    creation_date_time,
    last_edition_date_time,
    role,
    email_address,
    password_hash,
    salt,
    key_stretching_iterations,
    first_name,
    last_name,
    gender,
    inviter
)
VALUES (
	'admin',
	0,
    UTC_TIMESTAMP(),
    NULL,
    'ad',
    'neuco@example.com',
    UNHEX('dcceccccd2fa66ec724ac99b88fd4df9029646e15bf90cab7a7d118427031cd579b9187b0f32dc614100514c59b0b3db584b1f1a66b01dd4cf19951c518626c0'),
    UNHEX('0d041dbc8cd38a8d989a5a19a8746d79b706d28b72a1d1112f96ffd72d7d5cd2950034f1bd7a145959c84b49fcacb56d8d75069527a62ffaf886852255c305f3'),
    64000,
    'Usuario',
    'Administrador',
	'm',
    NULL
);

-- end attached script 'initial_data'
