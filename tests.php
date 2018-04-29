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
	font-family: 'Russo One', sans-serif;
	color:white;

}

}
a:link{
	text-decoration: none;
}
h2{
    padding: 10px;
    transition: transform .2s;
    width: 150px;
    height: 150px;
    margin-top: 190px;
    margin-right: 80px;
    text-align: center;
    display: inline-block;
    text-decoration: none;

}
h2:hover {
    -ms-transform: scale(1.0);
    -webkit-transform: scale(1.5); 
    transform: scale(1.5); 
    text-decoration: none;
}
button{
	width: 50%;
	margin-top: 20px;
}
nav{
	margin-top: 10px;
	font-family: 'Russo One', sans-serif;


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
							<li class="active"><a href='tests.php'>Тестове</a><li>
							<li><a href='rating.php'>Класация</a><li>
							<li><a href='dis.php'>Дискусия</a><li>
								<?php 
								echo "<li><a href='user.php?user_id=".$row['user_id']."'>Профил</a><li>";
								if ($_SESSION['email']==$row['email']&&$row['role']=='admin') {
									echo "<li><a href='admin.php'>Администратор</a></li>";
								}
								?></ul>
								<ul class="nav navbar-nav navbar-right">
									<li><a href='logout.php' style='clear:both'><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
									</ul>
							</div>
						</div>
					</nav>
					<center>
						
					<?php
							
						echo "<a href='test1.php'><h2>Ниско ниво на трудност</h2></a>";
						if ($row['level']>2) {
							echo "<a href='test2.php'><h2>Средно ниво на трудност</h2></a>";
						}
						else{
							echo "<h2><span class='glyphicon glyphicon-lock'></span>Средно ниво на трудност </h2>";
						}
						if ($row['level']>4) {
							echo "<a href='test3.php'><h2>Високо ниво на трудност</h2></a>";
						}
						else{
							echo "<h2><span class='glyphicon glyphicon-lock'></span>Високо ниво на трудност</h2>";
						}
						if ($row['level']>6) {
							echo "<a href='test4.php'><h2>Тест със снимки</h2></a>";
						}
						else{
							echo "<h2><span class='glyphicon glyphicon-lock'></span><br>Тест със снимки</h2>";
						}
						
								}
							}
						}
							?>	</center>	
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
		</script>
	</body>
	</html>