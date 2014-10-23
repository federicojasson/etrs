DELIMITER ; -- Sets the statement delimiter

-- Inserts users

INSERT INTO users (
	id,
	password_hash,
	role,
	salt
) VALUES (
	'federicojasson',
	UNHEX('ad93e638416c2d6aa48178ceb188113c1bf5587e1077da3fd91ba46515d515ab942533c066b0d63c4d474e5a01f38dabe936d3927180ff831c40cc3c5f5df315'),
	'DR',
	UNHEX('adf59df4453d42190da5f16cdb4488698865cf74cba19abff258136e0a482baac3843a98713d177cb92fc777d1c157f6d2f06a7581eb085b2d1878e8a63c51c1')
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
