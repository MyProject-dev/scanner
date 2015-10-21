<?php
 error_reporting(0);
if(!mysql_connect("localhost","root",""))
{
	die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db("scanner"))
{
	die('oops database selection problem ! --> '.mysql_error());
}

$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

$_SESSION['base_path_folder'] = 'E:\xampp\htdocs\project\ronalyn\ronalyn\upload1\scanned';
$_SESSION['main_folder_name'] = 'scanned';
?>