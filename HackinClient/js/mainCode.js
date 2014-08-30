/* 
 * This is the main jquery file that is used to handle most of the async things on the pages
 */

var AJAX_PAGE_NAME = 'ajax/user.php';
 
$(document).ready(function()	{
	//First of all things we have to start up the login script checker.
	$.post('ajax/check_login.php', {checkLogin : "true"}, function(data)	{
		//This is used to check the login stat of the user.
		var pData = JSON.parse(data);
		if(pData.login == false)	{
			loadLoginBox();
		} else {
			//Start the timer function.
			setInterval(loginChecker, 5000);
			setInterval(pointIncrementer, 15000);
		}
	});
});