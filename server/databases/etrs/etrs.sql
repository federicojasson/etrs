DELIMITER ; -- Sets the statement delimiter

START TRANSACTION; -- Executes all the statements or rollbacks

source etrs_cleanup.sql
source etrs_initialization.sql
source etrs_users.sql
source etrs_tables.sql
source etrs_views.sql
source etrs_procedures.sql
source etrs_triggers.sql
source etrs_debug_data.sql

COMMIT; -- Commits the transaction
