DELIMITER ; -- Sets the statement delimiter

--
-- View: sessions_system_view.
--
-- TODO
--
CREATE VIEW sessions_system_view AS
SELECT
	id,
	data
FROM sessions;

GRANT SELECT
ON etrs_server_database.sessions_system_view
TO 'etrs_system'@'localhost';
