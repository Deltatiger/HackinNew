/*
 * This is the file that handles some of the live event handlers.
 */
 

 
$(document).ready(function()	{
	$(document).on('click', '#loginButton' ,function()	{
		var uname = $('#uname').val();
		var upass = $('#upass').val();
		$.post('ajax/check_login.php', {login : "true", uname : uname, upass : upass}, function(data)	{
			var jsonData = JSON.parse(data);
			if(jsonData.login == true)	{
				//Clear all the boxes and login.
				$('#codeInfoDiv').html('');
				//Set the username.
				$('#topHeaderName').html('Welcome, ' + jsonData.username + '!');
				//Now we start the timer function
				setInterval(loginChecker, 5000);
				setInterval(pointIncrementer, 15000);
			} else {
				alert("Invalid Login Credentials");
			}
		});
	});
});