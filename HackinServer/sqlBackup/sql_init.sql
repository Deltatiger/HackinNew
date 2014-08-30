/* This is the new Modified DB */
CREATE TABLE IF NOT EXISTS t_user	(
	`user_id`				INT NULL AUTO_INCREMENT,
	`user_name`				VARCHAR(40),
	`user_pass`				TEXT,	/* This stores the hash as usual */
	`user_type`				BOOLEAN,
	/* 
	 *	user_type 			1 => ADMIN
	 *						0 => Regular User
	 */
	`user_points`			INT,
	`user_last_autoinc`		INT,
	`user_resuorce_id` 		INT,
	PRIMARY KEY(`user_id`)
);

/*
 * This table is used to hold the authentication keys that will be used by the users for each and every request.
 */
CREATE TABLE IF NOT EXISTS AuthTokenDetail	(
	`authtoken`				TEXT,
	`user_id`				INT,
	`logtime`				INT,
	`log_ip`				CHAR(16),
	PRIMARY KEY(`authtoken`)
);

/* Config Table */
CREATE TABLE IF NOT EXISTS t_config	(
	`config_name`			VARCHAR(60),
	`config_value`			TEXT,
	PRIMARY KEY (`config_name`)
);
