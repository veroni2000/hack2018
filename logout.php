<?php
session_start();
session_destroy();   
header("Location: login.php"); //It returns you to the login page after deestroing the session.
?>