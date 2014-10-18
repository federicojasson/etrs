DELIMITER !| -- Sets the statement delimiter

--
-- Procedure: delete_expired_sessions.
--
-- TODO: indicar que i_lifetime es la cantidad de SEGUNDOS
--
CREATE PROCEDURE delete_expired_sessions (
	IN i_lifetime INT
)
BEGIN
	-- Gets the current date and time
	DECLARE v_current_datetime DATETIME DEFAULT UTC_TIMESTAMP();

	-- Deletes the expired session rows
	DELETE FROM sessions
	WHERE last_access_datetime < DATE_SUB(v_current_datetime, INTERVAL i_lifetime SECOND);
END; !|

GRANT EXECUTE
ON PROCEDURE etrs_server_database.delete_expired_sessions
TO 'etrs_system'@'localhost';


--
-- Procedure: delete_session.
--
-- TODO
--
CREATE PROCEDURE delete_session (
	IN i_id VARCHAR(40)
)
BEGIN
	-- Deletes the session row
	DELETE FROM sessions
	WHERE id LIKE BINARY i_id
	LIMIT 1;
END; !|

GRANT EXECUTE
ON PROCEDURE etrs_server_database.delete_session
TO 'etrs_system'@'localhost';


--
-- Procedure: insert_or_update_session.
--
-- TODO
--
CREATE PROCEDURE insert_or_update_session (
	IN i_id VARCHAR(40),
	IN i_data BLOB
)
BEGIN
	-- Gets the current date and time
	DECLARE v_current_datetime DATETIME DEFAULT UTC_TIMESTAMP();
	
	-- Insert a new session row
	INSERT INTO sessions (
		id,
		creation_datetime,
		data,
		last_access_datetime
	) VALUES (
		i_id,
		v_current_datetime,
		i_data,
		v_current_datetime
	)
	ON DUPLICATE KEY
		-- A row for the session already exists
		-- Updates the session row
		UPDATE
			data = i_data,
			last_access_datetime = v_current_datetime;
END; !|

GRANT EXECUTE
ON PROCEDURE etrs_server_database.insert_or_update_session
TO 'etrs_system'@'localhost';
