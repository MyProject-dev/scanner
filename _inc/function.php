 <?php


        function imgToPdf($path, $name) {
            $image = $path . $name;
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->Image($image,20,40,170,170);
            return $pdf->Output();
        }

        /**
        * Uploading file to a folder
        */
        function uploadFile($target_dir) {

//            echo " asdasda sdas das dasd asda sda sdasd asdpath $target_dir <br>";
            $_SESSION['filePath'] = $target_dir;
            $_SESSION['fileName'] = basename($_FILES["fileToUpload"]["name"]);

            // $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);



            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


//                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    //Conver to pdf $target_dir

                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

//            echo ' <br> PATH: ' . $target_dir;
        }

        /*
         * Get path of the current open folder
         */
        function  file_path() {
              $path = (!empty($_GET['path']))? $_GET['path'] : '';
              $mainPath = $_SESSION['base_path_folder'] . $path;
              return $mainPath;
        }

         /**
          * File path get
          * @return string
          */
        function file_path_get() {
            return  (!empty($_GET['path']))? $_GET['path'] : '';
        }

         /**
          * @return string
          */
        function file_path_basename_get() {
            return  (!empty($_GET['path']))? basename($_GET['path']) : '';
        }

         /**
          * @param $path
          * @return array
          */
        function getContentCurrentFolder($path) {


            $files = array(); //= scandir(file_path());


            if ($handle = opendir($path)) {

                while (false !== ($entry = readdir($handle))) {

                    if ($entry != "." && $entry != "..") {

                        $files[] = $entry;
                    }
                }

                closedir($handle);
            }
            return $files;
        }

        /**
        * Mao ni ang pag return sa link para sa folder
        *
        */
        function print_link() {
            $path = (!empty($_GET['path']))? $_GET['path'] : '';
            $mainPath = $_SESSION['base_path_folder'] . $path;
            $pathArray = getPath($mainPath);
            foreach ($pathArray as $key => $value) {
                 $subPathDirectory = explode($_SESSION['main_folder_name'], $value)[1];
                // $link[] = "<a href=\"?path=$subPathDirectory\"> " . basename($value).PHP_EOL . " </a>";
                $link[] = $_SESSION['base_path_folder'] . $subPathDirectory;
            }
            return $link;
         }

         /**
         * Mao ni ang pag kuha sa folder path ug sa sub folder path infinity
         */

         /**
         *
         */
        function getPath($path) {
            $pathArray = array();
            $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path),
            RecursiveIteratorIterator::SELF_FIRST);
            $c = 0;
            foreach($iterator as $file) {
                if($file->isDir()) {
                   $pathArray[] = strtolower($file->getRealpath());
                }
            }
            return $result = array_unique($pathArray);
        }

         function redirect($location) {
             ?>
                <script>
                    document.location = '<?php echo $location ?>';
                </script>
            <?php
         }
    ?>