<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://cdn.firebase.com/js/client/2.3.2/firebase.js"></script>
</head>
<body>

    <?php
    define("UPLOAD_DIR", "selfies/");

// show upload form
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        ?>
        <em>Only GIF, JPG, and PNG files are allowed.</em>
        <form action="Start.php" method="post" enctype="multipart/form-data">
           <input type="text" name="username"/>
           <br/>
           <input type="file" name="selfie"/>
           <br/>
           <input type="submit" value="Upload"/>
       </form>
       <?php
   }
// process file upload
   else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $myFile = $_FILES["selfie"];
    $userName = $_POST["username"];

    if ($myFile["error"] !== UPLOAD_ERR_OK && empty($userName)) {
        echo "<p>Make sure you typed in your user name and chose your selfie.</p>";
        exit;
     } else if (empty($userName)){
        echo "<p>Make sure you typed in your user name.</p>";
        exit;
    } else if ($myFile["error"] !== UPLOAD_ERR_OK){
        echo "<p>Make sure you chose your selfie.</p>";
        exit;
    }

    // verify the file type
    $fileType = exif_imagetype($_FILES["selfie"]["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    if (!in_array($fileType, $allowed)) {
        echo "<p>File type is not permitted.</p>";
        exit;
    }

    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

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
        echo "<p>Unable to save file.</p>";
        exit;
    }

    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);
    
    //Attempt to display image
    echo "<p>Your User Name is " . $userName . ".</p>";
    echo "<p>Uploaded selfie saved as " . $name . ".</p>";

} 

?>

<script type="text/javascript">

   // var username = "<?php echo $username ?>";

    var userNames = new Firebase("https://incandescent-heat-4986.firebaseio.com/users/userNames");

    userNames.set({
        player1: "<?php echo $userName ?>",
        selfieName: "<?php echo $name ?>"
    });

</script>

<a href="Voting.html">Display Uploaded Photos</a>

</body>
</html>


