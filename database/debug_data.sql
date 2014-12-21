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
	'federicojasson@test.com',
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

INSERT INTO consultations (
	id,
	is_erased,
	creator,
	patient,
	creation_datetime,
	date,
	reasons,
	observations,
	indications
) VALUES (
	UNHEX('283db1dad6004f059e527bd9626a1f28'),
	FALSE,
	'federicojasson',
	UNHEX('1894068380304e0ca7ebf25d25e72dca'),
	UTC_TIMESTAMP(),
	'2013-05-01',
	'Síntomas del paciente',
	'',
	''
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
