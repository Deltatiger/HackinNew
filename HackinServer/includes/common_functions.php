<?php

/*
 * This contains all the common functions.
 */

function generateRandString($length)	{
    //This generates a random string of $length charecters long
    $randomString = '';
    $range = str_split('abcdefghijklmnopqrstuvwxyz1234567890<>?:"{}!@#$%^&*()_+', '1');
    for($i = 0; $i < $length; $i++)	{
        $randomString .= $range[array_rand($range)];
    }
    return $randomString;
}

function clean($strToClean)	{
	global $db;
	return $db->escapeString(trim($strToClean));
}
?>
