/*
 * This consists of all the javascript functions that are used everywhere.
 */

function loadLoginBox()	{
	//This loads the login box to the screen.
	if($('#codeInfoDiv').html() != '')	{
		return;
	}
	$('#codeInfoDiv').html(
		"<div id=\"loginBoxHolder\">" + 
		" <div id=\"loginBox\" class=\"absCenter\">" + 
		"  <div class=\"inputText textright\"> Username </div> " +
		"  <div class=\"inputBox\"> <input type=\"text\" id=\"uname\" > </div> " +
		"  <div class=\"clearDiv\"></div>" + 
		"  <div class=\"inputText textright\"> Password </div> " +
		"  <div class=\"inputBox\"> <input type=\"password\" id=\"upass\" > </div> " +
		"  <div class=\"clearDiv\"></div>" + 
		"  <div class=\"centerY mediumButton\">" + 
		"   <input type=\"button\" class=\"mediumButton\" value=\"Login\" id=\"loginButton\" />" +
		"  </div> " +
		" </div>" +
		"</div>"
	);
}

function loginChecker()	{
	//This is used to check the login status of the logged in user.
	$.post('ajax/loginAsync.php', {checkLoginAsync : "true"}, function(data)	{
		var jsonData = JSON.parse(data);
		if(jsonData.loginStatus == false)	{
			loadLoginBox();
		}
	});
}

function loadResourcePage()	{
	//This functions is used to relaod the resoruce box in the index page.
	$.post('ajax/getResource.php', {}, function(data)	{
		var jsonData = JSON.parse(data);
		if(jsonData.success == true)	{
			$('#resourceHolder').html(jsonData.content);
		}
	});
}

function pointIncrementer()	{
	//This function is used to increement the points of the user for every, say, 10 seconds.
	$.post('ajax/pointInc.php', {increement : "true"}, function(data)	{
		var jsonData = JSON.parse(data);
		if(jsonData.success == true)	{
			//Reload the resources box.
			loadResourcePage();
		}
	})
}