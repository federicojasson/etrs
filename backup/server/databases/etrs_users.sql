DELIMITER ; -- Sets the statement delimiter

-- Drops the users
-- To avoid errors if they don't exist, it creates them first

GRANT USAGE ON *.* TO
'etrs_admin'@'localhost',
'etrs_anonymous'@'localhost',
'etrs_doctor'@'localhost',
'etrs_operator'@'localhost',
'etrs_researcher'@'localhost',
'etrs_system'@'localhost';

DROP USER
'etrs_admin'@'localhost',
'etrs_anonymous'@'localhost',
'etrs_doctor'@'localhost',
'etrs_operator'@'localhost',
'etrs_researcher'@'localhost',
'etrs_system'@'localhost';


-- Creates the users
-- USAGE is used to specify that they have no privileges

GRANT USAGE ON *.* TO
'etrs_admin'@'localhost' IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',
'etrs_anonymous'@'localhost' IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',
'etrs_doctor'@'localhost' IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',
'etrs_operator'@'localhost' IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',
'etrs_researcher'@'localhost' IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',
'etrs_system'@'localhost' IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19';

-- TODO: 2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19 is 'password' (change it before release)
