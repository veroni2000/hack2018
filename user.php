<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Cosmos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
h2,h1,h3,h4{
	color: white;
}
button{
	width: 50%;
	margin-top: 20px;
}
nav{
	margin-top: 10px;
}
body{
		font-family: 'Russo One', sans-serif;
	color:white;
	}

</style>
</head>
<body background="img/background.jpg">
	<?php 
	include('db_connect.php');
	if(!isset($_SESSION['email']))
	{
		echo '<script> location.replace("login.php"); </script>'; //If you aren't logged in, you will be returned to the login page.
	}
	else{
		$email=$_SESSION['email'];
		$profile_id = $_GET['user_id'];
	$read_query = "SELECT * FROM  users where email='".$_SESSION['email']."'";  //Getting current user.
	$result = mysqli_query($conn, $read_query);
	if (mysqli_num_rows($result)>0) {
		while($row = mysqli_fetch_assoc($result)){
			$user_id=$row['user_id'];
			?>
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>                        
						</button>
						<a class="navbar-brand" href="index.php">Начало</a>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav">
							<li><a href='tests.php'>Тестове</a><li>
							<li><a href='rating.php'>Класация</a><li>
							<li><a href='dis.php'>Дискусия</a><li>
								<?php 
								echo "<li class='active'><a href='user.php?user_id=".$row['user_id']."'>Профил</a><li>";
								if ($_SESSION['email']==$row['email']&&$row['role']=='admin') {
									echo "<li><a href='admin.php'>Администратор</a></li>";
								}
								?></ul>
								<ul class="nav navbar-nav navbar-right">
									<li><a href='logout.php' style='clear:both'><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
									</ul>
							</div>
						</div>
					</nav>	<div style='margin-top: 50px; margin-left:40px'>
									<?php

								}
							}
						}
						$read_query = "SELECT * FROM users where user_id='".$profile_id."'"; 
$result = mysqli_query($conn, $read_query);

$query=mysqli_query($conn,"select * from image_2 where user_id='".$profile_id."' ORDER BY user_id DESC");
		$row=mysqli_fetch_array($query);
			?>
				<img style="float:left; margin-right: 30px" src="<?php echo $row['img_location']; ?>" height='300px'>
			<?php

if (mysqli_num_rows($result)>0) {
	while($row = mysqli_fetch_assoc($result)){	
		echo '<h2>'.$row['username'].'</h2>';
		echo "<h3>".$row['level']." ниво</h3>";
		echo "<h3>Рекорд: ".$row['record']."</h3>";
		echo '<h3>Брой точки от нивото: '.$row['points'].'</h3>';
if ($user_id==$profile_id) {
	echo "<h4><a href='update_user.php?user_id=" .$user_id. "'>Редактиране на профила</a></h4>";
}
	}
	
}

									?>
								
					</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
		</script>
	</body>
	</html>