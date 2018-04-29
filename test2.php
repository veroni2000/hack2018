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
		h1{
			color: white;
		}
		button{
			width: 50%;
			margin-top: 20px;
		}
		nav{
			margin-top: 10px;
		}
		.outter{
		height: 35px;
		width: 50%;
		border: solid 1px white;
		color: blue;
		margin-left: 25%;
		font-size: 20px;
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
			if ($_SESSION['email']==$row['email']&&$row['level']<3){echo '<script> location.replace("tests.php"); </script>';}
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
					}
				}
			}
			$br=0;
			$points=0;
			$read_query = "SELECT * FROM test2"; 
			$result = mysqli_query($conn, $read_query);
			if (mysqli_num_rows($result)>0) {
				while($row = mysqli_fetch_assoc($result)){	
					$br++;
				} 
			}
			$question1_id=rand(1,$br);

			if (!isset($_GET['a1'])) {		
				$read_query = "SELECT * FROM test2 where question_id = '$question1_id'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);	
					echo "<h1>".$row['question']."</h1>";
					echo "<a href='test2.php?q1=$question1_id&a1=a'><button><h2>".$row['a']."</h2></button></a><br>";
					echo "<a href='test2.php?q1=$question1_id&a1=b'><button><h2>".$row['b']."</h2></button></a><br>";
					echo "<a href='test2.php?q1=$question1_id&a1=c'><button><h2>".$row['c']."</h2></button></a>"; 
				}
			}
			elseif(!isset($_GET['a2'])) {
				$a1=$_GET['a1'];
				$q1=$_GET['q1'];
				$read_query = "SELECT * FROM test2 where question_id = '$q1'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					if ($a1==$row['right_answer']) {
						$points=$points+50;
					}
					else $points=$points-15;
				}
				do{$question2_id=rand(1,$br);}
				while ($question2_id==$q1);
				$read_query = "SELECT * FROM test2 where question_id = '$question2_id'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);	
					echo "<h1>".$row['question']."</h1>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$question2_id&a2=a'><button><h2>".$row['a']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$question2_id&a2=b'><button><h2>".$row['b']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$question2_id&a2=c'><button><h2>".$row['c']."</h2></button></a>"; 
				}
			}	
			elseif(!isset($_GET['a3'])) {
				$a1=$_GET['a1'];
				$a2=$_GET['a2'];
				$q1=$_GET['q1'];
				$q2=$_GET['q2'];
				$points=$_GET['p'];
				$read_query = "SELECT * FROM test2 where question_id = '$q2'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					if ($a2==$row['right_answer']) {
						$points=$points+50;
					}
					else $points=$points-15;
				}
				do{$question3_id=rand(1,$br);}
				while ($question3_id==$q1||$question3_id==$q2);
				$read_query = "SELECT * FROM test2 where question_id = '$question3_id'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);	
					echo "<h1>".$row['question']."</h1>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$question3_id&a3=a'><button><h2>".$row['a']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$question3_id&a3=b'><button><h2>".$row['b']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$question3_id&a3=c'><button><h2>".$row['c']."</h2></button></a>"; 
				}
			}
			elseif(!isset($_GET['a4'])) {
				$a1=$_GET['a1'];
				$a2=$_GET['a2'];
				$a3=$_GET['a3'];
				$q1=$_GET['q1'];
				$q2=$_GET['q2'];
				$q3=$_GET['q3'];
				$points=$_GET['p'];
				$read_query = "SELECT * FROM test2 where question_id = '$q3'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					if ($a3==$row['right_answer']) {
						$points=$points+50;
					}
					else $points=$points-15;
				}
				do{$question4_id=rand(1,$br);}
				while ($question4_id==$q1||$question4_id==$q2||$question4_id==$q3);
				$read_query = "SELECT * FROM test2 where question_id = '$question4_id'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);	
					echo "<h1>".$row['question']."</h1>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$question4_id&a4=a'><button><h2>".$row['a']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$question4_id&a4=b'><button><h2>".$row['b']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$question4_id&a4=c'><button><h2>".$row['c']."</h2></button></a>"; 
				}
			}

			elseif(!isset($_GET['a5'])) {
				$a1=$_GET['a1'];
				$q1=$_GET['q1'];
				$a2=$_GET['a2'];
				$q2=$_GET['q2'];
				$a3=$_GET['a3'];
				$q3=$_GET['q3'];
				$a4=$_GET['a4'];
				$q4=$_GET['q4'];
				$points=$_GET['p'];
				$read_query = "SELECT * FROM test2 where question_id = '$q4'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					if ($a4==$row['right_answer']) {
						$points=$points+50;
					}
					else $points=$points-15;
				}
				do{$question5_id=rand(1,$br);}
				while ($question5_id==$q1||$question5_id==$q2||$question5_id==$q3||$question5_id==$q4);
				$read_query = "SELECT * FROM test2 where question_id = '$question5_id'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);	
					echo "<h1>".$row['question']."</h1>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$question5_id&a5=a'><button><h2>".$row['a']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=b&q4=$q4&a4=$a4&q5=$question5_id&a5=b'><button><h2>".$row['b']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=c&q4=$q4&a4=$a4&q5=$question5_id&a5=c'><button><h2>".$row['c']."</h2></button></a>"; 
				}
			}

			elseif(!isset($_GET['a6'])) {
				$a1=$_GET['a1'];
				$q1=$_GET['q1'];
				$a2=$_GET['a2'];
				$q2=$_GET['q2'];
				$a3=$_GET['a3'];
				$q3=$_GET['q3'];
				$a4=$_GET['a4'];
				$q4=$_GET['q4'];
				$a5=$_GET['a5'];
				$q5=$_GET['q5'];
				$points=$_GET['p'];
				$read_query = "SELECT * FROM test2 where question_id = '$q5'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					if ($a5==$row['right_answer']) {
						$points=$points+50;
					}
					else $points=$points-15;
				}
				do{$question6_id=rand(1,$br);}
				while ($question6_id==$q1||$question6_id==$q2||$question6_id==$q3||$question6_id==$q4||$question6_id==$q5);
				$read_query = "SELECT * FROM test2 where question_id = '$question6_id'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);	
					echo "<h1>".$row['question']."</h1>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$question6_id&a6=a'><button><h2>".$row['a']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$question6_id&a6=b'><button><h2>".$row['b']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$question6_id&a6=c'><button><h2>".$row['c']."</h2></button></a>"; 
				}
			}

			elseif(!isset($_GET['a7'])) {
				$a1=$_GET['a1'];
				$q1=$_GET['q1'];
				$a2=$_GET['a2'];
				$q2=$_GET['q2'];
				$a3=$_GET['a3'];
				$q3=$_GET['q3'];
				$a4=$_GET['a4'];
				$q4=$_GET['q4'];
				$a5=$_GET['a5'];
				$q5=$_GET['q5'];
				$a6=$_GET['a6'];
				$q6=$_GET['q6'];
				$points=$_GET['p'];
				$read_query = "SELECT * FROM test2 where question_id = '$q6'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					if ($a6==$row['right_answer']) {
						$points=$points+50;
					}
					else $points=$points-15;
				}
				do{$question7_id=rand(1,$br);}
				while ($question7_id==$q1||$question7_id==$q2||$question7_id==$q3||$question7_id==$q4||$question7_id==$q5||$question7_id==$q6);
				$read_query = "SELECT * FROM test2 where question_id = '$question7_id'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);	
					echo "<h1>".$row['question']."</h1>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$q6&a6=$a6&q7=$question7_id&a7=a'><button><h2>".$row['a']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$q6&a6=$a6&q7=$question7_id&a7=b'><button><h2>".$row['b']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$q6&a6=$a6&q7=$question7_id&a7=c'><button><h2>".$row['c']."</h2></button></a>"; 
				}
			}
			elseif(!isset($_GET['a8'])) {
				$a1=$_GET['a1'];
				$q1=$_GET['q1'];
				$a2=$_GET['a2'];
				$q2=$_GET['q2'];
				$a3=$_GET['a3'];
				$q3=$_GET['q3'];
				$a4=$_GET['a4'];
				$q4=$_GET['q4'];
				$a5=$_GET['a5'];
				$q5=$_GET['q5'];
				$a6=$_GET['a6'];
				$q6=$_GET['q6'];
				$a7=$_GET['a7'];
				$q7=$_GET['q7'];
				$points=$_GET['p'];
				$read_query = "SELECT * FROM test2 where question_id = '$q7'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					if ($a7==$row['right_answer']) {
						$points=$points+50;
					}
					else $points=$points-15;
				}
				do{$question8_id=rand(1,$br);}
				while ($question8_id==$q1||$question8_id==$q2||$question8_id==$q3||$question8_id==$q4||$question8_id==$q5||$question8_id==$q6||$question8_id==$q7);
				$read_query = "SELECT * FROM test2 where question_id = '$question8_id'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);	
					echo "<h1>".$row['question']."</h1>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$q6&a6=$a6&q7=$q7&a7=$a7&q8=$question8_id&a8=a'><button><h2>".$row['a']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$q6&a6=$a6&q7=$q7&a7=$a7&q8=$question8_id&a8=b'><button><h2>".$row['b']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$q6&a6=$a6&q7=$q7&a7=$a7&q8=$question8_id&a8=c'><button><h2>".$row['c']."</h2></button></a>"; 
				}
			}

			elseif(!isset($_GET['a9'])) {
				$a1=$_GET['a1'];
				$q1=$_GET['q1'];
				$a2=$_GET['a2'];
				$q2=$_GET['q2'];
				$a3=$_GET['a3'];
				$q3=$_GET['q3'];
				$a4=$_GET['a4'];
				$q4=$_GET['q4'];
				$a5=$_GET['a5'];
				$q5=$_GET['q5'];
				$a6=$_GET['a6'];
				$q6=$_GET['q6'];
				$a7=$_GET['a7'];
				$q7=$_GET['q7'];
				$a8=$_GET['a8'];
				$q8=$_GET['q8'];
				$points=$_GET['p'];
				$read_query = "SELECT * FROM test2 where question_id = '$q8'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					if ($a8==$row['right_answer']) {
						$points=$points+50;
					}
					else $points=$points-15;
				}
				do{$question9_id=rand(1,$br);}
				while ($question9_id==$q1||$question9_id==$q2||$question9_id==$q3||$question9_id==$q4||$question9_id==$q5||$question9_id==$q6||$question9_id==$q7||$question9_id==$q8);
				$read_query = "SELECT * FROM test2 where question_id = '$question9_id'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);	
					echo "<h1>".$row['question']."</h1>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$q6&a6=$a6&q7=$q7&a7=$a7&q8=$q8&a8=$a8&q9=$question9_id&a9=a'><button><h2>".$row['a']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$q6&a6=$a6&q7=$q7&a7=$a7&q8=$q8&a8=$a8&q9=$question9_id&a9=b'><button><h2>".$row['b']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$q6&a6=$a6&q7=$q7&a7=$a7&q8=$q8&a8=$a8&q9=$question9_id&a9=c'><button><h2>".$row['c']."</h2></button></a>"; 
				}
			}
			elseif(!isset($_GET['a9'])) {
				$a1=$_GET['a1'];
				$q1=$_GET['q1'];
				$a2=$_GET['a2'];
				$q2=$_GET['q2'];
				$a3=$_GET['a3'];
				$q3=$_GET['q3'];
				$a4=$_GET['a4'];
				$q4=$_GET['q4'];
				$a5=$_GET['a5'];
				$q5=$_GET['q5'];
				$a6=$_GET['a6'];
				$q6=$_GET['q6'];
				$a7=$_GET['a7'];
				$q7=$_GET['q7'];
				$a8=$_GET['a8'];
				$q8=$_GET['q8'];
				$points=$_GET['p'];
				$read_query = "SELECT * FROM test2 where question_id = '$q8'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					if ($a8==$row['right_answer']) {
						$points=$points+50;
					}
					else $points=$points-15;
				}
				do{$question9_id=rand(1,$br);}
				while ($question9_id==$q1||$question9_id==$q2||$question9_id==$q3||$question9_id==$q4||$question9_id==$q5||$question9_id==$q6||$question9_id==$q7||$question9_id==$q8);
				$read_query = "SELECT * FROM test2 where question_id = '$question9_id'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);	
					echo "<h1>".$row['question']."</h1>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$q6&a6=$a6&q7=$q7&a7=$a7&q8=$q8&a8=$a8&q9=$q9&a9=$a9&q10=$question10_id&a10=a'><button><h2>".$row['a']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$q6&a6=$a6&q7=$q7&a7=$a7&q8=$q8&a8=$a8&q9=$q9&a9=$a9&q10=$question10_id&a10=b'><button><h2>".$row['b']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=$a3&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6=$q6&a6=$a6&q7=$q7&a7=$a7&q8=$q8&a8=$a8&q9=$q9&a9=$a9&q10=$question10_id&a10=c'><button><h2>".$row['c']."</h2></button></a>"; 
				}
			}
			elseif(!isset($_GET['a10'])) {
				$a1=$_GET['a1'];
				$q1=$_GET['q1'];
				$a2=$_GET['a2'];
				$q2=$_GET['q2'];
				$a3=$_GET['a3'];
				$q3=$_GET['q3'];
				$a4=$_GET['a4'];
				$q4=$_GET['q4'];
				$a5=$_GET['a5'];
				$q5=$_GET['q5'];
				$a6=$_GET['a6'];
				$q6=$_GET['q6'];
				$a7=$_GET['a7'];
				$q7=$_GET['q7'];
				$a8=$_GET['a8'];
				$q8=$_GET['q8'];
				$a9=$_GET['a9'];
				$q9=$_GET['q9'];
				$points=$_GET['p'];
				$read_query = "SELECT * FROM test2 where question_id = '$q9'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					if ($a9==$row['right_answer']) {
						$points=$points+50;
					}
					else $points=$points-15;
				}
				do{$question10_id=rand(1,$br);}
				while ($question10_id==$q1||$question10_id==$q2||$question10_id==$q3||$question10_id==$q4||$question10_id==$q5||$question10_id==$q6||$question10_id==$q7||$question10_id==$q8||$question10_id==$q9);
				$read_query = "SELECT * FROM test2 where question_id = '$question10_id'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);	
					echo "<h1>".$row['question']."</h1>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=b&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6&a6=$a6&q7&a7=$a7&q8=$q8&a8=$a8&q9=$q9&a9=$a9&q10=$question10_id&a10=a'><button><h2>".$row['a']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=b&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6&a6=$a6&q7&a7=$a7&q8=$q8&a8=$a8&q9=$q9&a9=$a9&q10=$question10_id&a10=b'><button><h2>".$row['b']."</h2></button></a><br>";
					echo "<a href='test2.php?p=$points&q1=$q1&a1=$a1&q2=$q2&a2=$a2&q3=$q3&a3=c&q4=$q4&a4=$a4&q5=$q5&a5=$a5&q6&a6=$a6&q7&a7=$a7&q8=$q8&a8=$a8&q9=$q9&a9=$a9&q10=$question10_id&a10=c'><button><h2>".$row['c']."</h2></button></a>"; 
				}
			}

			else{
				$a10=$_GET['a10'];
				$q10=$_GET['q10'];
				$points=$_GET['p'];
				$read_query = "SELECT * FROM test2 where question_id = '$q10'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					if ($a10==$row['right_answer']) {
						$points=$points+50;
					}
					else $points=$points-15;
				}

				$read_query = "SELECT * FROM users where email = '$email'"; 
				$result = mysqli_query($conn, $read_query);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					$user_points=$row['points'];
					if ($points<=$row['record']) {
						if ($points>0) {
								echo "<h1>".$points." точки</h1>";
								$user_points=$user_points+$points;
							}
							else{ echo "<h1>0 точки</h1>";
							$user_points=0;}
						$update_query = "UPDATE users SET points= $user_points WHERE email = '$email' ";
						$result = mysqli_query($conn, $update_query); 
						if ($result) {
						}
					}
					else {
						$user_points=$user_points+$points;
						$update_query = "UPDATE users SET record = $points WHERE email = '$email' ";
						$result = mysqli_query($conn, $update_query); 
						if ($result) {
							echo "<h1>".$points." точки</h1>";
							echo "<h2 style='color:white'>Подобрихте личния си рекорд!</h2>";
						}

						$update_query = "UPDATE users SET points= $user_points WHERE email = '$email' ";
						$result = mysqli_query($conn, $update_query); 
						if ($result) {
						}
					}
					if ($user_points >= 1000) {
							echo '<script> location.replace("level.php?level=2"); </script>';
							$update_query = "UPDATE users SET level='2', points='$p' WHERE email = '$email' ";
							$result = mysqli_query($conn, $update_query); 
							if ($result) {
							}
						}
						if ($row['level']==1) {
							$level1=1;
							$leve2=2;
							$total = 1000;
							$current = $user_points;
							$percent = round(($current/$total)*100,1);
							if ($percent<=0) {
								$percent=0;
								$current=0;
							}
						}

						if ($user_points >= 1500) {
							echo '<script> location.replace("level.php?level=3"); </script>';
							$update_query = "UPDATE users SET level='3', points='0' WHERE email = '$email' ";
							$result = mysqli_query($conn, $update_query); 
							if ($result) {
							}
						}
						if ($row['level']==2) {
							$level1=2;
							$leve2=3;
							$total = 1500;
							$current = $user_points;
							$percent = round(($current/$total)*100,1);
							if ($percent<=0) {
								$percent=0;$current=0;
							}
						}
						if ($user_points >= 2000) {
							echo '<script> location.replace("level.php?level=4"); </script>';
							$update_query = "UPDATE users SET level='4', points='0' WHERE email = '$email' ";
							$result = mysqli_query($conn, $update_query); 
							if ($result) {
							}
						}

						if ($row['level']==3) {
							$level1=3;
							$leve2=4;
							$total = 2000;
							$current = $user_points;
							$percent = round(($current/$total)*100,1);
							if ($percent<=0) {
								$percent=0;$current=0;
							}
						}
						if ($user_points >= 2500) {
							echo '<script> location.replace("level.php?level=5"); </script>';
							$update_query = "UPDATE users SET level='5', points='0' WHERE email = '$email' ";
							$result = mysqli_query($conn, $update_query); 
							if ($result) {
							}
						}
						if ($row['level']==4) {
							$level1=4;
							$leve2=5;
							$total = 2500;
							$current = $user_points;
							$percent = round(($current/$total)*100,1);
							if ($percent<=0) {
								$percent=0;$current=0;
							}
							
						}
						if ($user_points >= 3000) {
							echo '<script> location.replace("level.php?level=6"); </script>';
							$update_query = "UPDATE users SET level='6', points='0' WHERE email = '$email' ";
							$result = mysqli_query($conn, $update_query); 
							if ($result) {
							}
						}
						if ($row['level']==5) {
							$level1=5;
							$leve2=6;
							$total = 3000;
							$current = $user_points;
							$percent = round(($current/$total)*100,1);
							if ($percent<=0) {
								$percent=0;$current=0;
							}
							
						}
						if ($user_points >= 3500) {
							echo '<script> location.replace("level.php?level=7"); </script>';
							$update_query = "UPDATE users SET level='7', points='0' WHERE email = '$email' ";
							$result = mysqli_query($conn, $update_query); 
							if ($result) {
							}
						}
						if ($row['level']==6) {
							$level1=6;
							$leve2=7;
							$total = 3500;
							$current = $user_points;
							$percent = round(($current/$total)*100,1);
							if ($percent<=0) {
								$percent=0;$current=0;
							}
							
						}
						if ($user_points >= 4000) {
							echo '<script> location.replace("level.php?level=8"); </script>';
							$update_query = "UPDATE users SET level='8', points='0' WHERE email = '$email' ";
							$result = mysqli_query($conn, $update_query); 
							if ($result) {
							}
						}
						if ($row['level']==7) {
							$level1=7;
							$leve2=8;
							$total = 4000;
							$current = $user_points;
							$percent = round(($current/$total)*100,1);
							if ($percent<=0) {
								$percent=0;$current=0;
							}	
						}
						if ($user_points >= 4500) {
							echo '<script> location.replace("level.php?level=9"); </script>';
							$update_query = "UPDATE users SET level='9', points='0' WHERE email = '$email' ";
							$result = mysqli_query($conn, $update_query); 
							if ($result) {
							}
						}
						if ($row['level']==8) {
							$level1=8;
							$leve2=9;
							$total = 4500;
							$current = $user_points;
							$percent = round(($current/$total)*100,1);
							if ($percent<=0) {
								$percent=0;$current=0;
							}
						}
						if ($user_points >= 5000) {
							echo '<script> location.replace("level.php?level=10"); </script>';
							$update_query = "UPDATE users SET level='10', points='0', role='admin' WHERE email = '$email' ";
							$result = mysqli_query($conn, $update_query); 
							if ($result) {
							}
						}
						if ($row['level']==9) {
							$level1=9;
							$leve2=10;
							$total = 5000;
							$current = $user_points;
							$percent = round(($current/$total)*100,1);
							if ($percent<=0) {
								$percent=0;$current=0;
							}
							
						}

				}
				?>
</center><?php
				echo "<div class='outter'><div class='inner'>".$current."/".$total." (".$percent."%)</div></div>";
				echo "<center style='margin-top:-50px;'><h3 style=''><span style='margin-right:57%;'>".$level1." ниво</span>".$leve2." ниво</h3></center>";
			}
			if(!isset($_GET['a10'])){
				echo '<p id="timer" style="margin-top: 30px; color: white; font-size: 30px"></p>';}
				?>
			
<style type="text/css">.inner{
		height: 35px;
		width:<?php echo $percent; ?>%;
		border-right: solid 1px white;
		text-align: center;
		background-color: #40FF00;
	}</style>

			<script type="text/javascript">
				var seconds = 10;
				function secondPassed() {
					var minutes = Math.round((seconds - 30)/60),
					remainingSeconds = seconds % 60;

					if (remainingSeconds < 10) {
						remainingSeconds = "0" + remainingSeconds;
					}

					document.getElementById('timer').innerHTML = minutes + ":" + remainingSeconds;
					if (seconds == 0) {
						clearInterval(countdownTimer);

					} else {
						seconds--;
					}if (remainingSeconds==0) {location.replace("tests.php");}
					if (remainingSeconds==3||remainingSeconds==2||remainingSeconds==1) {
						document.getElementById('timer').style.color = "#ff0000";
						document.getElementById('timer').style.fontSize = "45px";
					}
				}
				var countdownTimer = setInterval('secondPassed()', 1000);

				if (performance.navigation.type == 1) {
    location.replace("tests.php");
  }

			</script>
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js">

			</script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
			</script>
		</body>
		</html>