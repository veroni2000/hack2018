<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Register</title>
	<meta charset="utf-8">
	<style>
		body {
		background-size: 100%;
	}
	@font-face {
   font-family: 'Russo One', sans-serif;
    src: url(sansation_light.woff);
}
h1,h3,input,form,h4{
	font-family: 'Russo One', sans-serif;
	font-weight: bold;
}
	form { 

margin-top:8%; 
width:250px;
padding-top:2%
}
a{
  font-family: 'Russo One', sans-serif;
	text-decoration: none;
	color: white;
	font-weight: bold;
}

.btn{
	font-family: 'Russo One', sans-serif;
	font-weight: bold;
	
}
.kk{
background: rgba(21,27,84,0.7);
border-radius: 15px;
width: 330px;
height: 350px;
margin-left: 500px;
margin-top: 140px;
}
</style>
</head>
<body background="img/k.jpg">
<div class="kk">
<center>
	
	<form action="" method="POST" class="inline">
		<h1 style="color: white;">Регистрация</h1>
		<div class="form-group">
			<input type="text" name="username" placeholder="Потребителско име" class="form-control" />
		</div>
		<div class="form-group">
			<input type="email" name="email" placeholder="Имейл" class="form-control" />
		</div>
		<div class="form-group">
			<input type="password" name="password" placeholder="Парола" class="form-control" />
		</div>
		<div class="form-group">
			<input style=" 
	background-color: #151B54;
    color: white;
    padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    color:white;
    font-family: 'Russo One', sans-serif;
    " type="submit" name="submit" value="Регистрирай се" class="btn"/>
		</div>
	</form>
	
<?php
echo "<h3><a href='login.php' style='font-family: 'Russo One', sans-serif;'>Влез</a></h3>";
include('db_connect.php');
if (isset($_POST['submit'])) {
	if($_POST['email']==''||$_POST['username']==''||$_POST['password']=='')
	{
		echo "<h4><font color='red'>Попълни всички полета.</font></h4>";
	}
	else{
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$read_query = "SELECT * FROM  users where email='".$email."'";  
		$result = mysqli_query($conn, $read_query);
	if (mysqli_num_rows($result)>0) { //Checking if the email is taken.
		echo "<h4><font color='red'>Вече е регистриран такъв имейл.</font></h4>";
	}
	else{$insert_query = "INSERT INTO users (email,username,password) VALUES ('$email','$username','$password')";
	if (mysqli_query($conn, $insert_query)) {
		echo '<script> location.replace("login.php"); </script>';
	    //Redirecting to the login page right after the registration is completed
	} else {
		echo "Error: " . $insert_query . " - " . mysqli_error($conn);
	}
}
}
}
?>
</center>
</div>
</body>
</html>