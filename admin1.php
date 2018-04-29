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
		h2{
			color: white;
		}
		button{
			width: 50%;
			margin-top: 20px;
		}
		nav{
			margin-top: 10px;
		}
		form { 
			margin: 0 auto; 
			width:45%;
			padding-top:2%;
			color: black;
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
	$read_query = "SELECT * FROM  users where email='".$_SESSION['email']."'";  //Getting current user.
	$result = mysqli_query($conn, $read_query);
	if (mysqli_num_rows($result)>0) {
		while($row = mysqli_fetch_assoc($result)){
			if ($_SESSION['email']==$row['email']&&$row['role']!='admin'){echo '<script> location.replace("index.php"); </script>';
				// Only admins can see this page, if other users try to open it they'll be redirected.
		}
		?>
		<nav class="navbar navbar-inverse">
			<div class="collapse navbar-collapse" id="myNavbar">
			<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>                        
						</button>
						<a class="navbar-brand" href="index.php">Начало</a>
					</div>
				<ul class="nav navbar-nav">
					<li><a href='tests.php'>Тестове</a><li>
						<li><a href='rating.php'>Класация</a><li>
						<li><a href='dis.php'>Дискусия</a><li>
							<?php 
							echo "<li><a href='user.php?user_id=".$row['user_id']."'>Профил</a><li>";
							if ($_SESSION['email']==$row['email']&&$row['role']=='admin') {
								echo "<li class='active'><a href='admin.php'>Администратор</a></li>";
							}
							?></ul>
							<ul class="nav navbar-nav navbar-right">
								<li><a href='logout.php' style='clear:both'><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
							</ul>
						</div>
					</div>
				</nav></li>
				<?php
			}
		}
	}
	?>	
	<center>
		

<h2>Въвеждане на информация</h2>
		<form action="" method="POST" class="inline">
			<div class="form-group">
				<input type="text" name="planet" placeholder="Обект" class="form-control" />
			</div>
			<div class="form-group">
				<input type="text" name="planet_inf" placeholder="Информация" class="form-control" />
			</div>
			<div class="form-group">
				<input type="submit" name="submit2" value="Запази" class="btn btn-default"/>
			</div>
		</form>

<a href="admin.php"><h4>Въвеждане на въпрос</h4></a>
		<?php

if (isset($_POST['submit2'])) {
				$planet = $_POST['planet'];
				$planet_inf = $_POST['planet_inf'];

					$insert_query = "INSERT INTO inf (planet,planet_inf) VALUES ('$planet','$planet_inf')";
					if (mysqli_query($conn, $insert_query)) {
					} else {
						echo "Error: " . $insert_query . " - " . mysqli_error($conn);
					}

			}
			

		?>
	</center>	

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js">
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	</script>
</body>
</html>