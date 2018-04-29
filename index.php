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
nav{
			margin-top: 10px;
		}
body{
		font-family: 'Russo One', sans-serif;
	color:white;}
img.sun{
	width: 25%;
	
	margin-top: 110px;
	margin-left:-150px;
	

}
img.mer{
	width: 5%;
	height: 5%;
	margin-left: 0.5%;
	transition: transform .2s;

}
img.mer:hover{
	 /*-ms-transform: scale(1.5); /* IE 9 */
    /*-webkit-transform: scale(1.5);  Safari 3-8 */
    /*transform: scale(1.5); */
    /*background: url('background/image/mer1.gif');*/
}
img{
	transition: transform .2s;
}
img:hover{
	-ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Safari 3-8 */
    transform: scale(1.5);
}
img.ven{
	width: 6%;
	height: 6%;
	margin-top: 150px;
	margin-left: 0.5%;
}
img.zemq{
	width: 8%;
	height: 8%;
	margin-left: 1%;

}
img.mars{
	width: 6%;
	height: 6%;
	margin-left: 2.5%;
	margin-top: 60px;
}
img.upi{
	width: 12%;
	height: 12%;
	margin-left: 3%;
}
img.sat{
	width: 20%;
	height: 20%;
	margin-left: 2%;
	margin-top: 130px;
}
img.uran{
	width: 6%;
	height: 6%;
	margin-left: 2%;
}
img.nep{
	width: 5.5%;
	height: 5.5%;
	margin-left: 2%;
	margin-top: 100px;
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
									echo "<li><a href='admin.php'>Администратор</a></li>";
								}
								?></ul>
								<ul class="nav navbar-nav navbar-right">
									<li><a href='logout.php' style='clear:both'><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
									</ul>
							</div>
						</div>
					</nav>	<?php
								}
							}
						}	
					?>
					
					<a href="inf.php?planet_id=1"><img src="img/sun.png" class="sun"></a>
					<a href="inf.php?planet_id=2"><img class="mer" src="img/mer.png" onmouseover="this.src='img/mer.gif'; this.height='80px'" onmouseout="this.src='img/mer.png'"></a>
					<a href="inf.php?planet_id=3"><img class="ven" src="img/ven.png" onmouseover="this.src='img/ven.gif'; this.height='80px'" onmouseout="this.src='img/ven.png'"></a>
					<a href="inf.php?planet_id=4"><img class="zemq" src="img/zemq.png" onmouseover="this.src='img/zemq.gif'; this.height='80px'" onmouseout="this.src='img/zemq.png'"></a>
					<a href="inf.php?planet_id=5"><img class="mars" src="img/mars.png" onmouseover="this.src='img/mars.gif'; this.height='80px'" onmouseout="this.src='img/mars.png'"></a>
					<a href="inf.php?planet_id=6"><img class="upi" src="img/upi.png" onmouseover="this.src='img/upi.gif'; this.height='80px'" onmouseout="this.src='img/upi.png'"></a>
					<a href="inf.php?planet_id=7"><img class="sat" src="img/sat.png" onmouseover="this.src='img/sat.gif'; this.height='80px'" onmouseout="this.src='img/sat.png'"></a>
					<a href="inf.php?planet_id=8"><img class="uran" src="img/uran.png" onmouseover="this.src='img/uran.gif'; this.height='80px'" onmouseout="this.src='img/uran.png'"></a>
					<a href="inf.php?planet_id=9"><img class="nep" src="img/nep.png" onmouseover="this.src='img/nep.gif'; this.height='80px'" onmouseout="this.src='img/nep.png'"></a>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
		</script>
	</body>
	</html>