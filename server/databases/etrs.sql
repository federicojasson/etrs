DELIMITER ; -- Sets the statement delimiter

START TRANSACTION; -- Executes all the statements or rollbacks

-- Users
source etrs_users.sql

-- Business database
source etrs_business/etrs_business_initialization.sql
source etrs_business/etrs_business_tables.sql
source etrs_business/etrs_business_views.sql
source etrs_business/etrs_business_procedures.sql
source etrs_business/etrs_business_triggers.sql

-- Server database
source etrs_server/etrs_server_initialization.sql
source etrs_server/etrs_server_tables.sql
source etrs_server/etrs_server_views.sql
source etrs_server/etrs_server_procedures.sql
source etrs_server/etrs_server_triggers.sql

-- Debug data
source etrs_debug_data.sql

COMMIT; -- Commits the transaction
