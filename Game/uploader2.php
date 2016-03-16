<?php session_start(); ?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://cdn.firebase.com/js/client/2.3.2/firebase.js"></script>
    <!-- <script src="//code.jquery.com/jquery-1.12.0.min.js"></script> -->
</head>

<body>

<?php
define("UPLOAD_DIR", "uploads/");

// show upload form
if ($_SERVER["REQUEST_METHOD"] == "GET") {

?>
<em>Only GIF, JPG, and PNG files are allowed.</em>
<form action="uploader2.php" method="post" enctype="multipart/form-data">
 <input type="file" name="myFile"/>
 <br/>
  <input type="file" name="myFile2"/>
 <br/>
  <input type="file" name="myFile3"/>
 <br/>
  <input type="file" name="myFile4"/>
 <br/>
  <input type="file" name="myFile5"/>
 <br/>
  <input type="file" name="myFile6"/>
 <br/>
 <input type="submit" value="Upload"/>

</form>
<?php
}

// process file upload
else if ($_SERVER["REQUEST_METHOD"] == "POST" ) { //&& !empty($_FILES["myFile"])
    $myFile = $_FILES["myFile"];
    $myFile2 = $_FILES["myFile2"];
    $myFile3 = $_FILES["myFile3"];
    $myFile4 = $_FILES["myFile4"];
    $myFile5 = $_FILES["myFile5"];
    $myFile6 = $_FILES["myFile6"];
    if ($myFile["error"] !== UPLOAD_ERR_OK || $myFile2["error"] !== UPLOAD_ERR_OK  || $myFile3["error"] !== UPLOAD_ERR_OK  || $myFile4["error"] !== UPLOAD_ERR_OK  || $myFile5["error"] !== UPLOAD_ERR_OK  || $myFile6["error"] !== UPLOAD_ERR_OK) {
        echo "<p>Go back and ensure 6 files are selected.</p>"; 
        echo "<p><a href='uploader2.php'>Go Back</a></p>";

        exit;
    }

    // verify the file type
    $fileType = exif_imagetype($_FILES["myFile"]["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    $errorsFound = 0;

    if (!in_array($fileType, $allowed)) {
        echo "<p>File type is not permitted on image 1.</p>";
        $errorsFound = $errorsFound + 1;
    }

    $fileType = exif_imagetype($_FILES["myFile2"]["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    if (!in_array($fileType, $allowed)) {
        echo "<p>File type is not permitted on image 2.</p>";
        $errorsFound = $errorsFound + 1;
    }

    $fileType = exif_imagetype($_FILES["myFile3"]["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    if (!in_array($fileType, $allowed)) {
        echo "<p>File type is not permitted on image 3.</p>";
        $errorsFound = $errorsFound + 1;
    }

    $fileType = exif_imagetype($_FILES["myFile4"]["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    if (!in_array($fileType, $allowed)) {
        echo "<p>File type is not permitted on image 4.</p>";
        $errorsFound = $errorsFound + 1;
    }

    $fileType = exif_imagetype($_FILES["myFile5"]["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    if (!in_array($fileType, $allowed)) {
        echo "<p>File type is not permitted on image 5.</p>";
        $errorsFound = $errorsFound + 1;
    }

    $fileType = exif_imagetype($_FILES["myFile6"]["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    if (!in_array($fileType, $allowed)) {
        echo "<p>File type is not permitted on image 6.</p>";
        $errorsFound = $errorsFound + 1;
    }

    if ($errorsFound > 0) {
        echo "<p><br>Please go back and try again.</p>";
        exit;
    }

    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
    $name2 = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile2["name"]);
    $name3 = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile3["name"]);
    $name4 = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile4["name"]);
    $name5 = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile5["name"]);
    $name6 = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile6["name"]);

    /*Upload File 1*/

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DIR . $name);
    if (!$success) {
        echo "<p>Unable to save file 1.</p>";
        exit;
    }

    // set proper permissions on the new files
    chmod(UPLOAD_DIR . $name, 0644);

    /*Upload File 2*/

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name2);
    while (file_exists(UPLOAD_DIR . $name2)) {
        $i++;
        $name2 = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile2["tmp_name"], UPLOAD_DIR . $name2);
    if (!$success) {
        echo "<p>Unable to save file 2.</p>";
        exit;
    }

    // set proper permissions on the new files
    chmod(UPLOAD_DIR . $name2, 0644);

    /*Upload File 3*/

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name3);
    while (file_exists(UPLOAD_DIR . $name3)) {
        $i++;
        $name3 = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile3["tmp_name"], UPLOAD_DIR . $name3);
    if (!$success) {
        echo "<p>Unable to save file 3.</p>";
        exit;
    }

    // set proper permissions on the new files
    chmod(UPLOAD_DIR . $name3, 0644);

     
    /*Upload File 4*/

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name4);
    while (file_exists(UPLOAD_DIR . $name4)) {
        $i++;
        $name4 = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile4["tmp_name"], UPLOAD_DIR . $name4);
    if (!$success) {
        echo "<p>Unable to save file 4.</p>";
        exit;
    }

    // set proper permissions on the new files
    chmod(UPLOAD_DIR . $name4, 0644);

    /*Upload File 5*/

// don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name5);
    while (file_exists(UPLOAD_DIR . $name5)) {
        $i++;
        $name5 = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile5["tmp_name"], UPLOAD_DIR . $name5);
    if (!$success) {
        echo "<p>Unable to save file 5.</p>";
        exit;
    }

    // set proper permissions on the new files
    chmod(UPLOAD_DIR . $name5, 0644);

    /*Upload File 6*/

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name6);
    while (file_exists(UPLOAD_DIR . $name6)) {
        $i++;
        $name6 = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile6["tmp_name"], UPLOAD_DIR . $name6);
    if (!$success) {
        echo "<p>Unable to save file 6.</p>";

        exit;
    }

    // set proper permissions on the new files
    chmod(UPLOAD_DIR . $name6, 0644);

    //*** Togo: Get userName from cookie
    //Currently defaulting to player1 if it's not found
    $userName = $_SESSION['userName'];

    //send filenames to firebase

    ?>
    <script type="text/javascript">

    var ref = new Firebase("https://incandescent-heat-4986.firebaseio.com/images/");

    //*** Todo: Replace "player1" with userName from cookie
    //var usersRef = ref.child("player1");
    //usersRef.set({
    ref.update({

//****Todo: Replace "player1" with value userName from cookie inside of <?php ?> tags
//Suggestion: User variable $userName to store value from cookie in PHP and us it here
        <?php echo $userName ?>_image1:  {
        filename: "<?php echo $name ?>",
        player: "<?php echo $userName ?>"
            },
        <?php echo $userName ?>_image2: {
        filename: "<?php echo $name2 ?>",
        player: "<?php echo $userName ?>"
            },
        <?php echo $userName ?>_image3: {
        filename: "<?php echo $name3 ?>",
        player: "<?php echo $userName ?>"
            },
        <?php echo $userName ?>_image4: {
        filename: "<?php echo $name4 ?>",
        player: "<?php echo $userName ?>"
            },
        <?php echo $userName ?>_image5: {
        filename: "<?php echo $name5 ?>",
        player: "<?php echo $userName ?>"
            },
        <?php echo $userName ?>_image6: {
        filename: "<?php echo $name6 ?>",
        player: "<?php echo $userName ?>"
            },
    });
    </script>
    <?php
    
    //Attempt to display image
    echo "<p>Uploaded file saved as " . $name . ".</p>";
    echo "<p>Uploaded file saved as " . $name2 . ".</p>";
    echo "<p>Uploaded file saved as " . $name3 . ".</p>";
    echo "<p>Uploaded file saved as " . $name4 . ".</p>";
    echo "<p>Uploaded file saved as " . $name5 . ".</p>";
    echo "<p>Uploaded file saved as " . $name6 . ".</p>";

    echo "<br><p><a href='Voting.html'>Time to Vote! Click here to continue</a></p>";

}
?>

</body>
</html>


