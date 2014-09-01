/* This is the new Modified DB */
CREATE TABLE IF NOT EXISTS hacker	(
	`user_id`					INT NULL AUTO_INCREMENT,
	`user_name`					VARCHAR(40),
	`user_pass`					TEXT,	/* This stores the hash as usual */
	`user_type`					BOOLEAN,
	/* 
	 *	user_type 				1 => ADMIN
	 *							0 => Regular User
	 */
	`user_points`				INT,
	`user_last_autoinc`			INT,
	`user_resource_id` 			INT,
	`user_resource_add_unit`	INT,
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

/* This is used to hold certain countries that are allocated to each of the users */
CREATE TABLE IF NOT EXISTS countries	(
	`country`				VARCHAR(50),
	`user_id`				INT UNIQUE,
	PRIMARY KEY (`country`)
);

INSERT INTO countries VALUES ('India', NULL);
INSERT INTO countries VALUES ('USA', NULL);
INSERT INTO countries VALUES ('Russia', NULL);
INSERT INTO countries VALUES ('Germany', NULL);
INSERT INTO countries VALUES ('France', NULL);
INSERT INTO countries VALUES ('Japan', NULL);
INSERT INTO countries VALUES ('China', NULL);
INSERT INTO countries VALUES ('Australia', NULL);
INSERT INTO countries VALUES ('Sri Lanka', NULL);
INSERT INTO countries VALUES ('Mexico', NULL);
INSERT INTO countries VALUES ('Iran', NULL);
INSERT INTO countries VALUES ('Singapore', NULL);
INSERT INTO countries VALUES ('South Africa', NULL);
INSERT INTO countries VALUES ('Alaska', NULL);
INSERT INTO countries VALUES ('Argentina', NULL);
INSERT INTO countries VALUES ('Malaysia', NULL);
INSERT INTO countries VALUES ('UAE', NULL);


CREATE TABLE  ResourceTable	(
	`resource_id`		INT,
	`resource_name`		VARCHAR(40),
	PRIMARY KEY(`resource_id`)
);


CREATE TABLE PlayerResourceTable(
	`user_id`			INT,
	`resource_id`		INT,
	`resource_quantity` INT,
	`PricePerUnit` 		INT,
	PRIMARY KEY(`user_id`,`resource_id`)
);

