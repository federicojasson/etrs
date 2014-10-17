DELIMITER ; -- Sets the statement delimiter

START TRANSACTION; -- Executes all the statements or rollbacks

source etrs_server_cleanup.sql
source etrs_server_initialization.sql
source etrs_server_users.sql
source etrs_server_tables.sql
source etrs_server_views.sql
source etrs_server_procedures.sql
source etrs_server_triggers.sql
source etrs_server_debug_data.sql

COMMIT; -- Commits the transaction
