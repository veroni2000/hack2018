<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Login</title>
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
a{  font-family: 'Russo One', sans-serif;
	text-decoration: none;
	color: white;
}
	form { 
margin-top:10%; 
width:250px;
padding-top:2%;

}
.kk{
background: rgba(21,27,84,0.7);
border-radius: 15px;
width: 330px;
height: 327px;
margin-left: 500px;
margin-top: 140px;
}
.btn{
	font-family: 'Russo One', sans-serif;
	font-weight: bold;

}
.reg{
	font-family: 'Russo One', sans-serif;
	font-weight: bold;
	font-color: red;

	
}

</style>
</head>
<body background="img/k.jpg">
<div class="kk">

<center> 
	
	<form action="" method="POST" class="inline">
		<h1 style="color: white ;font-family: 'Russo One', sans-serif;
	font-weight: bold;">Влизане</h1>
		<div class="form-group">
			<input type="email" name="email" placeholder="Имейл" class="form-control" />
		</div>
		<div class="form-group">
			<input type="password" name="password" placeholder="Парола" class="form-control" />
		</div>
		<div class="form-group">
			<input style=" 
	background-color: #923145;
    color: white;
    padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    color:white;

    " type="submit" name="submit" value="Влез" class="btn"/>
	</form>
	
	
</div>


<?php
echo "<h3 class='reg'><a href='register.php'>Регистрирай се</a><h3>";
include('db_connect.php');
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password']; 
	$select_query = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'"; 
	$result = mysqli_query($conn, $select_query);
	if (mysqli_num_rows($result)>0) {  //Checking for  valid email and password
		$_SESSION['email']=$email;
		echo '<script> location.replace("index.php"); </script>';
	} else {
		echo "<h4><font color='red'>Грешно потребителско име или парола!</font></h4>";
	}
}

?>
</center>
</div>
</body>
</html>