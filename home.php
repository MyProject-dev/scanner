<?php
session_start();
include_once 'dbconnect.php';
require('_inc/function.php');

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>
<link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="_inc/css/style.css">
</head>
<body>
<div id="header">
	<div id="left">
    <label>Scanner</label>
    </div>
    <div id="right">
    	<div id="content">





        	hi' <?php echo $userRow['username']; ?>&nbsp;<a href="logout.php?logout">Sign Out</a>



        </div>
    </div>
</div>

<div id="body">
    <div class="upload-status" >

    </div>
    <div class="folder-menu" >
        <ul>
            <div class="upload-status" >
                <?php
                // Mao ni ang mo accept sa gi upload nga image
                // and file makita sa _inc/function.php
                // daun sa function name kai: uploadFile()
                // mo work ni if mag upload ug image den e click ang submit
                if(isset($_POST['submit'])) {
                    uploadFile($_POST['filePath']);
                }
                ?>
            </div>

            <?php
            foreach (print_link() as $link) {

                $subPathDirectory = explode('scanned', $link)[1];
                $bName = basename($link);

                // mao ang nag print main directory
                // folder container
                if( file_path_basename_get() == $bName) {
                    echo "<li class='active' > <a  href='?path=$subPathDirectory'>  <h3> $bName </h3>  </a><li>";
                } else {
                    echo "<li> <a href='?path=$subPathDirectory'> <h3> $bName </h3> </a><li>";
                }

                //content of the folder
                // daun mao ang sub directory ex: images


                    if( file_path_basename_get() == $bName) {
                        echo "<ul class='active' >";
                    } else {
                        echo "<ul>";
                    }
                ?>
                    <?php if( file_path_basename_get() == $bName) { ?>
                        <?php foreach (getContentCurrentFolder($link) as $key => $value) { ?>
                            <li>
                                <table border='1'  >
                                    <tr>
                                        <td  width="200px"   > <?php echo $value; ?> </td>
                                </table>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <hr>




            <?php } ?>

        </ul>
    </div>

    <br><br><br>
    <div class="folder-upload" >
        <h4> Upload Your scanned Image.. </h4>
        <form action="home.php?path=<?php echo file_path_get(); ?>" method="post" enctype="multipart/form-data">
            <input   type="hidden" value="<?php echo file_path(); ?>\" name="filePath" />
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>

    </div>
<!--    -->
<!--    <a href="http://cleartuts.blogspot.com/">cleartuts - programming blog</a><br />-->
<!--    <p>Focuses on PHP, MySQL, Ajax, jQuery, Web Design and more...</p>-->
</div>

</body>
</html>