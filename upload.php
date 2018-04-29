<?php
session_start();
?>
<meta charset="utf-8">
<?php
include('db_connect.php');
if (isset($_POST['question_id'])) {
	$question_id=$_POST['question_id'];
	$fileinfo=PATHINFO($_FILES["image"]["name"]);
$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
move_uploaded_file($_FILES["image"]["tmp_name"],"img/" . $newFilename);
$location="img/" . $newFilename;
mysqli_query($conn,"insert into image_tb (img_location,question_id) values ('$location','$question_id')");

$update_query = "UPDATE `test4` SET `image`= '$newFilename' WHERE `question_id` = '$question_id' ";
$result = mysqli_query($conn, $update_query); 
if ($result) {}

echo "<script> location.replace('admin.php'); </script>";
}

if (isset($_POST['user_id'])) {
	$user_id=$_POST['user_id'];
$delete_query = "DELETE FROM image_2 WHERE user_id = $user_id ";
$result = mysqli_query($conn, $delete_query);
if ($result) {}
	$fileinfo=PATHINFO($_FILES["image"]["name"]);
$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
move_uploaded_file($_FILES["image"]["tmp_name"],"img/" . $newFilename);
$location="img/" . $newFilename;
mysqli_query($conn,"insert into image_2 (img_location,user_id) values ('$location','$user_id')");

echo "<script> location.replace('user.php?user_id=" .$user_id . "'); </script>";

}
?>