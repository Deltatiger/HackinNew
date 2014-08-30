/* This is the new Modified DB */
CREATE TABLE IF NOT EXISTS t_user	(
	`user_id`				INT NULL AUTO_INCREMENT,
	`user_name`				VARCHAR(40),
	`user_pass`				TEXT,	/* This stores the hash as usual */
	`user_type`				BOOLEAN,
	`user_points`			INT,
	`user_last_autoinc`		INT,
	`user_resuorce_id` 		INT,
	/* 
	 *	user_type 			1 => ADMIN
	 *						0 => Regular User
	 */
	PRIMARY KEY(`user_id`)
);

/* TODO : Create a table for resources in the game.*/
/* ID, NAME */

/* Session Table */
CREATE TABLE IF NOT EXISTS t_session   (
	`session_id`            VARCHAR(60),
	`session_user_id`       int,
	`session_create_time`   int,
	`session_last_active`   int,
	`session_create_ip`     text,
	`session_browser`       text,
	`session_login_stat`    int DEFAULT 0,
	PRIMARY KEY (`session_id`)
);

/* Config Table */
CREATE TABLE IF NOT EXISTS t_config	(
	`config_name`			VARCHAR(60),
	`config_value`			TEXT,
	PRIMARY KEY (`config_name`)
);