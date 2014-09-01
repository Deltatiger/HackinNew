/* 
 * This is the main jquery file that is used to handle most of the async things on the pages
 */

$(document).ready(function()	{
	//First of all things we have to start up the login script checker.
	$.post('ajax/check_login.php', {checkLogin : "true"}, function(data)	{
		//This is used to check the login stat of the user.
		var pData = JSON.parse(data);
		if(pData.login == false)	{
			loadLoginBox();
		}
		//Set the point incrementer here if required.
		setInterval(pointIncrementer, 10000);
	});
	
	$.('#composeMail').on();
});