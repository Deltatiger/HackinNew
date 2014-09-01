

CREATE TABLE  PlayerTable	(
	`login_id`					INT,
	`native_resource_id`		INT,
	`freezed`					BOOLEAN,
	`native_resource_gen_unit`	INT,
	`native_resource_gen_time`	INT,
	`last_sheild_time`			INT,
	`last_attack_time`			INT,
	`money`						INT,
	PRIMARY KEY(`login_id`)
);

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
          
CREATE TABLE WeaponTable(
	`weapon_id`	 	INT,
	`weapon_name`   VARCHAR(40),
	`weapon_description` VARCHAR(60),
	`entity_affected`	INT,
	`quantity_affected`	INT,
	PRIMARY KEY(`weapon_id`)
);

CREATE TABLE SheildTable(
	`sheild_id`	INT,
	`sheild_name` VARCHAR(40),
	`sheild_time_out` INT,
	PRIMARY KEY(`sheild_id`)

); 
CREATE TABLE SheildingList(
	`sheild_id`  INT,
	`weapon_id`  INT,
	FOREIGN KEY(`sheild_id`) references SheildTable(`sheild_id`),
	FOREIGN KEY(`weapon_id`) references WeaponTable(`weapon_id`),
	PRIMARY KEY(`sheild_id`,`weapon_id`)
);
CREATE TABLE PlayersWeapons(
	`login_id`	INT,
	`weapon_id`	INT,
	`weapon_count`	INT,
	`last_used_time` INT,
	`re_use_time`	INT,
	`next_attack_time` INT,
	FOREIGN KEY(`login_id`) references PlayerTable(`login_id`),
	FOREIGN KEY(`weapon_id`) references WeaponTable(`weapon_id`),
	PRIMARY KEY(`login_id`,`weapon_id`)
);
CREATE TABLE PlayersSheilds(
	`login_id`	INT,
	`sheild_id`	INT,
	`sheild_count` INT,
	`sheild_enabled` BOOLEAN,
	`last_used_time` INT,
	`re_use_time` INT,
	`next_attack_time` INT,
	FOREIGN KEY(`login_id`) references PlayerTable(`login_id`),
	FOREIGN KEY(`sheild_id`) references SheildTable(`sheild_id`),
	PRIMARY KEY(`login_id`,`sheild_id`)
);
	