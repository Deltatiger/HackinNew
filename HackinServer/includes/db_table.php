<?php
	$dbName = $db->name();
	/* Define all table names as constants */
	define('USER_DETAIL'		, '`'.$dbName.'`.`t_user`');
	define('CONFIG'				, '`'.$dbName.'`.`t_config`');
	define('SESSION'			, '`'.$dbName.'`.`t_session`');
	define('AUTH_DETAIL'		, '`'.$dbName.'`.`authtokendetail`');
	define('COUNTRIES'			, '`'.$dbName.'`.`countries`');
	define('RESOURCE_DETAIL'	, '`'.$dbName.'`.`resourcetable`');
	define('PLAYER_RESOURCE'	, '`'.$dbName.'`.`playerresourcetable`');
?>