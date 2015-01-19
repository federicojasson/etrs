USE etrs_web_server;
SET NAMES utf8;

INSERT INTO users (
	id,
	creation_datetime,
	last_edition_datetime,
	first_name,
	last_name,
	gender,
	email_address,
	role,
	password_hash,
	salt,
	key_derivation_iterations
) VALUES (
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'Federico Rodrigo',
	'Jasson',
	'm',
	'etrs@mailinator.com',
	'ad',
	UNHEX('fca0a15eca8a9754e24a702761cd4c898e35e1b3ac37019b8e2f210b6a43b4e983d662f9821d2ac886d3d32595709c335e838396f2f4b80ce794646ed9a6d4d8'),
	UNHEX('0d041dbc8cd38a8d989a5a19a8746d79b706d28b72a1d1112f96ffd72d7d5cd2950034f1bd7a145959c84b49fcacb56d8d75069527a62ffaf886852255c305f3'),
	64000
);

USE etrs_business_logic;
SET NAMES utf8;

INSERT INTO patients (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	first_name,
	last_name,
	gender,
	birth_date,
	education_years
) VALUES (
	UNHEX('1894068380304e0ca7ebf25d25e72dca'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'Josefina',
	'Martínez',
	'f',
	'1985-12-20',
	10
);

INSERT INTO files (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	name,
	hash
) VALUES (
	UNHEX('5d4a52954eb440899df7474154b96ba0'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'report1.pdf',
	UNHEX('8C7DD922AD47494FC02C388E12C00EAC')
);

INSERT INTO files (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	name,
	hash
) VALUES (
	UNHEX('6346a6dfce5540598544b65cbdcc2bf5'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'archivo1.pdf',
	UNHEX('867DD9250347494FC021388E11500cae')
);

INSERT INTO files (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	name,
	hash
) VALUES (
	UNHEX('0f54836d16144515a9cbe3facd147545'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'archivo2.pdf',
	UNHEX('117aa92502474900C0f1388E113b07a8')
);

INSERT INTO experiments (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	name,
	command_line
) VALUES (
	UNHEX('a16f4de5cf164c508fec3a1aa45455fd'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'Experimento de Eye Tracking 1',
	'programa.exe -f :input'
);

INSERT into experiments_files (
	experiment,
	file
) VALUES (
	UNHEX('a16f4de5cf164c508fec3a1aa45455fd'),
	UNHEX('0f54836d16144515a9cbe3facd147545')
);

INSERT INTO diagnoses (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	name
) VALUES (
	UNHEX('b6aff0cecc964aab848c3539f8c56f14'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'Demencia tipo Alzheimer'
);

INSERT INTO clinical_impressions (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	name
) VALUES (
	UNHEX('67f86454a18a4d2d88a7185b78e7aaae'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'Demencia'
);

INSERT INTO treatments (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	name
) VALUES (
	UNHEX('076ded42464b4a3cb4a284c6b969bd1e'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'Taller neurocognitivo'
);

INSERT INTO medications (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	name
) VALUES (
	UNHEX('5c7bafdf4aaf459f9eda4e6d991e03a4'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'Levotiroxina'
);

INSERT INTO backgrounds (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	name
) VALUES (
	UNHEX('fed917638d304431a12d4670af9bca9d'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'Cardiopatía'
);

INSERT INTO image_tests (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	name,
	data_type_definition
) VALUES (
	UNHEX('0b7b260b05584ac992494ee548770b4e'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'RMN con patrón frontotemporal',
	'type:boolean;Sí:true;No:false'
);

INSERT INTO neurocognitive_tests (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	name,
	data_type_definition
) VALUES (
	UNHEX('9deea86b950e484f809e532d0a0196a4'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'MMSE',
	'type:integer_range;min:0;max:30'
);

INSERT INTO laboratory_tests (
	id,
	is_erased,
	creator,
	last_editor,
	creation_datetime,
	last_edition_datetime,
	name,
	data_type_definition
) VALUES (
	UNHEX('57f76e03c90445049f1e3222a17a72f0'),
	FALSE,
	'federicojasson',
	'federicojasson',
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'Triglicéridos',
	'type:integer_fix_values;Normal:0;Alto:1'
);

INSERT INTO consultations (
	id,
	is_erased,
	clinical_impression,
	diagnosis,
	creator,
	last_editor,
	patient,
	creation_datetime,
	last_edition_datetime,
	date,
	reasons,
	observations,
	indications
) VALUES (
	UNHEX('283db1dad6004f059e527bd9626a1f28'),
	FALSE,
	UNHEX('67f86454a18a4d2d88a7185b78e7aaae'),
	UNHEX('b6aff0cecc964aab848c3539f8c56f14'),
	'federicojasson',
	'federicojasson',
	UNHEX('1894068380304e0ca7ebf25d25e72dca'),
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	'2013-05-01',
	'Síntomas del paciente',
	'',
	''
);

INSERT INTO consultations_neurocognitive_tests (
	consultation,
	neurocognitive_test,
	value
) VALUES (
	UNHEX('283db1dad6004f059e527bd9626a1f28'),
	UNHEX('9deea86b950e484f809e532d0a0196a4'),
	27
);

INSERT INTO consultations_backgrounds (
	consultation,
	background
) VALUES (
	UNHEX('283db1dad6004f059e527bd9626a1f28'),
	UNHEX('fed917638d304431a12d4670af9bca9d')
);

INSERT INTO consultations_image_tests (
	consultation,
	image_test,
	value
) VALUES (
	UNHEX('283db1dad6004f059e527bd9626a1f28'),
	UNHEX('0b7b260b05584ac992494ee548770b4e'),
	FALSE
);

INSERT INTO consultations_laboratory_tests (
	consultation,
	laboratory_test,
	value
) VALUES (
	UNHEX('283db1dad6004f059e527bd9626a1f28'),
	UNHEX('57f76e03c90445049f1e3222a17a72f0'),
	1
);

INSERT INTO consultations_medications (
	consultation,
	medication
) VALUES (
	UNHEX('283db1dad6004f059e527bd9626a1f28'),
	UNHEX('5c7bafdf4aaf459f9eda4e6d991e03a4')
);

INSERT INTO consultations_treatments (
	consultation,
	treatment
) VALUES (
	UNHEX('283db1dad6004f059e527bd9626a1f28'),
	UNHEX('076ded42464b4a3cb4a284c6b969bd1e')
);

INSERT INTO studies (
	id,
	is_erased,
	consultation,
	experiment,
	creator,
	last_editor,
	report,
	creation_datetime,
	last_edition_datetime,
	observations
) VALUES (
	UNHEX('cb34783c21264abfb4fc0b371bd2b2fa'),
	FALSE,
	UNHEX('283db1dad6004f059e527bd9626a1f28'),
	UNHEX('a16f4de5cf164c508fec3a1aa45455fd'),
	'federicojasson',
	'federicojasson',
	NULL,
	UTC_TIMESTAMP(),
	UTC_TIMESTAMP(),
	''
);

INSERT into studies_files (
	study,
	file
) VALUES (
	UNHEX('cb34783c21264abfb4fc0b371bd2b2fa'),
	UNHEX('6346a6dfce5540598544b65cbdcc2bf5')
);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf05d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '1 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf15d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '2 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf35d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '3 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf45d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '4 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf55d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '5 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf65d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '6 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf75d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '7 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf85d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '8 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf95d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '9 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf06d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '10 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf16d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '11 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf26d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '12 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf36d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '13 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf46d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '14 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf56d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '15 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf66d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '16 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf76d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '17 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf86d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '18 Martínez', 'f', '1985-12-20', 10);

INSERT INTO patients (id, is_erased, creator, last_editor, creation_datetime, last_edition_datetime, first_name, last_name, gender, birth_date, education_years)
VALUES (UNHEX('1894068380304e0ca7ebf96d25e72dca'), FALSE, 'federicojasson', 'federicojasson', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 'Josefina', '19 Martínez', 'f', '1985-12-20', 10);