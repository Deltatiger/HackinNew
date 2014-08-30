/*
 * This table is used to hold the authentication keys that will be used by the users for each and every request.
 */

/* Config Table */
CREATE TABLE IF NOT EXISTS t_config	(
	`config_name`			VARCHAR(60),
	`config_value`			TEXT,
	PRIMARY KEY (`config_name`)
);

/*
 * This contains the details such as,
 * AUTH_TOKEN
 * TEAM_NAME
 */