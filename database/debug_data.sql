USE etrs_business_logic;

INSERT INTO users (
	id,
	is_erased,
	creation_datetime,
	first_names,
	last_names,
	gender,
	email_address,
	role,
	password_hash,
	password_salt,
	password_iterations
) VALUES (
	'federicojasson',
	FALSE,
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

INSERT INTO patients (
	id,
	is_erased,
	creator,
	creation_datetime,
	first_names,
	last_names,
	gender,
	birth_date,
	education_years
) VALUES (
	UNHEX('1894068380304e0ca7ebf25d25e72dca'),
	FALSE,
	'federicojasson',
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
	creation_datetime,
	name,
	hash
) VALUES (
	UNHEX('5d4a52954eb440899df7474154b96ba0'),
	FALSE,
	'federicojasson',
	UTC_TIMESTAMP(),
	'report1.pdf',
	UNHEX('8C7DD922AD47494FC02C388E12C00EAC')
);

INSERT INTO files (
	id,
	is_erased,
	creator,
	creation_datetime,
	name,
	hash
) VALUES (
	UNHEX('6346a6dfce5540598544b65cbdcc2bf5'),
	FALSE,
	'federicojasson',
	UTC_TIMESTAMP(),
	'archivo1.pdf',
	UNHEX('867DD9250347494FC021388E11500cae')
);

INSERT INTO files (
	id,
	is_erased,
	creator,
	creation_datetime,
	name,
	hash
) VALUES (
	UNHEX('0f54836d16144515a9cbe3facd147545'),
	FALSE,
	'federicojasson',
	UTC_TIMESTAMP(),
	'archivo2.pdf',
	UNHEX('117aa92502474900C0f1388E113b07a8')
);

INSERT INTO experiments (
	id,
	is_erased,
	creator,
	creation_datetime,
	name,
	command_line
) VALUES (
	UNHEX('a16f4de5cf164c508fec3a1aa45455fd'),
	FALSE,
	'federicojasson',
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
	creation_datetime,
	name
) VALUES (
	UNHEX('b6aff0cecc964aab848c3539f8c56f14'),
	FALSE,
	'federicojasson',
	UTC_TIMESTAMP(),
	'Demencia tipo Alzheimer'
);

INSERT INTO clinical_impressions (
	id,
	is_erased,
	creator,
	creation_datetime,
	name
) VALUES (
	UNHEX('67f86454a18a4d2d88a7185b78e7aaae'),
	FALSE,
	'federicojasson',
	UTC_TIMESTAMP(),
	'Demencia'
);

INSERT INTO treatments (
	id,
	is_erased,
	creator,
	creation_datetime,
	name
) VALUES (
	UNHEX('076ded42464b4a3cb4a284c6b969bd1e'),
	FALSE,
	'federicojasson',
	UTC_TIMESTAMP(),
	'Taller neurocognitivo'
);

INSERT INTO medications (
	id,
	is_erased,
	creator,
	creation_datetime,
	name
) VALUES (
	UNHEX('5c7bafdf4aaf459f9eda4e6d991e03a4'),
	FALSE,
	'federicojasson',
	UTC_TIMESTAMP(),
	'Levotiroxina'
);

INSERT INTO backgrounds (
	id,
	is_erased,
	creator,
	creation_datetime,
	name
) VALUES (
	UNHEX('fed917638d304431a12d4670af9bca9d'),
	FALSE,
	'federicojasson',
	UTC_TIMESTAMP(),
	'Cardiopatía'
);

INSERT INTO image_tests (
	id,
	is_erased,
	creator,
	creation_datetime,
	name,
	data_type_definition
) VALUES (
	UNHEX('0b7b260b05584ac992494ee548770b4e'),
	FALSE,
	'federicojasson',
	UTC_TIMESTAMP(),
	'RMN con patrón frontotemporal',
	'type:boolean;Sí:true;No:false'
);

INSERT INTO neurocognitive_evaluations (
	id,
	is_erased,
	creator,
	creation_datetime,
	name,
	data_type_definition
) VALUES (
	UNHEX('9deea86b950e484f809e532d0a0196a4'),
	FALSE,
	'federicojasson',
	UTC_TIMESTAMP(),
	'MMSE',
	'type:integer_range;min:0;max:30'
);

INSERT INTO laboratory_tests (
	id,
	is_erased,
	creator,
	creation_datetime,
	name,
	data_type_definition
) VALUES (
	UNHEX('57f76e03c90445049f1e3222a17a72f0'),
	FALSE,
	'federicojasson',
	UTC_TIMESTAMP(),
	'Triglicéridos',
	'type:integer_fix_values;Normal:0;Alto:1'
);

INSERT INTO consultations (
	id,
	is_erased,
	clinical_impression,
	creator,
	diagnosis,
	patient,
	creation_datetime,
	date,
	reasons,
	observations,
	indications
) VALUES (
	UNHEX('283db1dad6004f059e527bd9626a1f28'),
	FALSE,
	UNHEX('67f86454a18a4d2d88a7185b78e7aaae'),
	'federicojasson',
	UNHEX('b6aff0cecc964aab848c3539f8c56f14'),
	UNHEX('1894068380304e0ca7ebf25d25e72dca'),
	UTC_TIMESTAMP(),
	'2013-05-01',
	'Síntomas del paciente',
	'',
	''
);

INSERT INTO consultations_neurocognitive_evaluations (
	consultation,
	neurocognitive_evaluation,
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
	creator,
	experiment,
	report,
	creation_datetime,
	observations
) VALUES (
	UNHEX('cb34783c21264abfb4fc0b371bd2b2fa'),
	FALSE,
	UNHEX('283db1dad6004f059e527bd9626a1f28'),
	'federicojasson',
	UNHEX('a16f4de5cf164c508fec3a1aa45455fd'),
	NULL,
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
