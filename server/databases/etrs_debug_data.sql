DELIMITER ; -- Sets the statement delimiter

USE etrs_business_database

-- Inserts users

INSERT INTO users (
	id,
	password_hash,
	role
) VALUES (
	'federicojasson',
	UNHEX('b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86'),
	'DR'
);


-- Inserts patients

INSERT INTO patients (
	id,
	is_erased
) VALUES (
	UNHEX('6e338612e99a471eaa5c1446f6340b20'),
	FALSE
);

INSERT INTO patients_backgrounds (
	patient_id,
	edition_datetime,
	dbt,
	dyslipidemia,
	ect,
	heart_disease,
	hiv,
	htn,
	psychiatric_treatment,
	relatives_with_alzheimer
) VALUES (
	UNHEX('6e338612e99a471eaa5c1446f6340b20'),
	UTC_TIMESTAMP(),
	true,
	true,
	true,
	true,
	true,
	true,
	true,
	true
);

INSERT INTO patients_basic_data (
	patient_id,
	birth_date,
	gender,
	name,
	years_of_education
) VALUES (
	UNHEX('6e338612e99a471eaa5c1446f6340b20'),
	NULL,
	'F',
	'María Rodríguez',
	10
);

INSERT INTO patients_medications (
	patient_id,
	edition_datetime,
	antidepressants,
	antidiabetics,
	antihypertensives,
	antiplatelets_anticoagulants,
	antipsychotics,
	benzodiazepines,
	hypolipidemics,
	levothyroxine,
	melatonin
) VALUES (
	UNHEX('6e338612e99a471eaa5c1446f6340b20'),
	UTC_TIMESTAMP(),
	NULL,
	true,
	true,
	true,
	true,
	true,
	true,
	false,
	NULL
);
