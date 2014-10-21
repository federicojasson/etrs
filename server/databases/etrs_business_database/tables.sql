DELIMITER ; -- Sets the statement delimiter

--
-- Table: users.
--
-- This table stores information about the users of the system.
--
-- The users are identified by an ID. This is just a username.
--
-- Each user has a password. For security reasons, only a hash of the password
-- is stored in here. The SHA-512 hash function must be used for this purpose.
-- Also, a 512-bits salt is used to avoid rainbow-table attacks.
--
-- Every user has a role that indicates what kind of actions can perform in the
-- system.
--
-- Roles (and their corresponding 2-bytes values):
-- - Doctor ('DR').
-- - Operator ('OP').
-- - Researcher ('RS').
--
CREATE TABLE IF NOT EXISTS users (
	id VARCHAR(32), -- Maximum: 32 characters
	
	password_hash BINARY(64) NOT NULL, -- SHA-512: 512 bits = 64 bytes
	role BINARY(2) NOT NULL,
	salt BINARY(64) NOT NULL, -- 512 bits = 64 bytes
	
	PRIMARY KEY(id)
) ENGINE = InnoDB;

GRANT SELECT ON TABLE etrs_business_database.users TO
'etrs_anonymous'@'localhost',
'etrs_doctor'@'localhost'; -- TODO: remove


--
-- Table: patients.
--
-- This table stores the patients IDs.
--
-- Each patient is identified with a random-generated UUID.
--
-- For the sake of persistence, the patient information is never directly
-- deleted from the database by the user. Instead, a flag indicates whether that
-- data must be taken into account.
--
CREATE TABLE IF NOT EXISTS patients (
	id BINARY(16), -- UUID version 4: 128 bits = 16 bytes
	
	is_erased BOOLEAN NOT NULL,
	
	PRIMARY KEY(id)
) ENGINE = InnoDB;


--
-- Table: patients_backgrounds.
--
-- This table stores the medical backgrounds of the patients.
--
-- To keep a history of the patient, every time that the background of a patient
-- is changed, a new row is inserted and the current datetime is saved.
--
-- Every field is optional. A null value indicates that a certain data is
-- unknown.
--
-- Fields:
-- - Whether the patient has been treated with DBT (dialectical behavior
--   therapy).
-- - Whether the patient suffers from dyslipidemia.
-- - Whether the patient has been treated with ECT (electroconvulsive therapy).
-- - Whether the patient has a history of heart diseases.
-- - Whether the patient suffers from HIV.
-- - Whether the patient has a history of hypertension (HTN).
-- - Whether the patient has been treated psychiatrically.
-- - Whether the patient has first-degree relatives with Alzheimer.
--
CREATE TABLE IF NOT EXISTS patients_backgrounds (
	patient_id BINARY(16),
	edition_datetime DATETIME,
	
	dbt BOOLEAN,
	dyslipidemia BOOLEAN,
	ect BOOLEAN,
	heart_disease BOOLEAN,
	hiv BOOLEAN,
	htn BOOLEAN,
	psychiatric_treatment BOOLEAN,
	relatives_with_alzheimer BOOLEAN,
	
	PRIMARY KEY(patient_id, edition_datetime),
	FOREIGN KEY(patient_id) REFERENCES patients(id)
) ENGINE = InnoDB;

-- TODO: ?
GRANT SELECT
ON TABLE etrs_business_database.patients_backgrounds
TO 'etrs_doctor'@'localhost';


--
-- Table: patients_basic_data.
--
-- This table stores the basic data of the patients.
--
-- Every field is optional. A null value indicates that a certain data is
-- unknown.
--
-- Fields:
-- - Birth date.
-- - Gender.
-- - Name (both the first and the last names).
-- - Years of education.
--
-- Genders (and their corresponding 1-byte values):
-- - Female ('F').
-- - Male ('M').
--
CREATE TABLE IF NOT EXISTS patients_basic_data (
	patient_id BINARY(16),
	
	birth_date DATE,
	gender BINARY(1),
	name VARCHAR(128),
	years_of_education TINYINT UNSIGNED,
	
	PRIMARY KEY(patient_id),
	FOREIGN KEY(patient_id) REFERENCES patients(id)
) ENGINE = InnoDB;


--
-- Table: patients_medications.
--
-- This table stores the concomitant medications of the patients.
--
-- To keep a history of the patient, every time that the medications of a
-- patient are changed, a new row is inserted and the current datetime is saved.
--
-- Every field is optional. A null value indicates that a certain data is
-- unknown.
--
-- Fields:
-- - Whether the patient is taking antidepressants.
-- - Whether the patient is taking antidiabetics.
-- - Whether the patient is taking antihypertensives.
-- - Whether the patient is taking antiplatelets or anticoagulants.
-- - Whether the patient is taking antipsychotics.
-- - Whether the patient is taking benzodiazepines.
-- - Whether the patient is taking hypolipidemics.
-- - Whether the patient is taking levothyroxine.
-- - Whether the patient is taking melatonin.
--
CREATE TABLE IF NOT EXISTS patients_medications (
	patient_id BINARY(16),
	edition_datetime DATETIME,
	
	antidepressants BOOLEAN,
	antidiabetics BOOLEAN,
	antihypertensives BOOLEAN,
	antiplatelets_anticoagulants BOOLEAN,
	antipsychotics BOOLEAN,
	benzodiazepines BOOLEAN,
	hypolipidemics BOOLEAN,
	levothyroxine BOOLEAN,
	melatonin BOOLEAN,
	
	PRIMARY KEY(patient_id, edition_datetime),
	FOREIGN KEY(patient_id) REFERENCES patients(id)
) ENGINE = InnoDB;
