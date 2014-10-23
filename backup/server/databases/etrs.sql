DELIMITER ; -- Sets the statement delimiter

START TRANSACTION; -- Executes all the statements or rollbacks

-- Users
source etrs_users.sql

-- Business database
source etrs_business_database/initialization.sql
source etrs_business_database/tables.sql
source etrs_business_database/views.sql
source etrs_business_database/procedures.sql
source etrs_business_database/triggers.sql
source etrs_business_database/debug_data.sql

-- Server database
source etrs_server_database/initialization.sql
source etrs_server_database/tables.sql
source etrs_server_database/views.sql
source etrs_server_database/procedures.sql
source etrs_server_database/triggers.sql

COMMIT; -- Commits the transaction
