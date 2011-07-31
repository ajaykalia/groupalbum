<!-- File: /app/views/users/register.ctp -->

<h1>Register users</h1>

<form action="../users/register" method ="post">
	<p>Please fill out the form below to register an account.</p>
	<label>Username:</label><input name = "username" size = 40" />
	<label>Password:</label><input type = "password" name = "password" size = "40" />	
	<label>E-mail address:</label><input name = "email" size ="40" maxlength ="255" />
	<label>First name:</label><input name = "first_name" size = 40" />
	<label>Last name:</label><input name = "last_name" size = 40" />
	<input type ="submit" value = "register" />
</form>
