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
			} else {
				alert(jsonData.message);
			}
		});
	});
});