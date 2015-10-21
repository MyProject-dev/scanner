<?php
session_start();
include_once 'dbconnect.php';
require('_inc/function.php');

// Mao ni ang mo accept sa gi upload nga image
// and file makita sa _inc/function.php
// daun sa function name kai: uploadFile()
// mo work ni if mag upload ug image den e click ang submit
if(isset($_POST['submit'])) {

    echo "submitted " . $_POST['filePath'] . '<br>';
    uploadFile($_POST['filePath']);


}
$home = $_SESSION['base_path_folder'];
$path = file_path_get();


$redirect = $home . $path;

//$redirect= 'google.com';


echo "<br><br><br> $redirect";
?>


<?php
echo "
<script>
    document.location =  \"home.php?path=$path\";
</script>";
?>