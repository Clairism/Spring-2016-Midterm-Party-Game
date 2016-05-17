<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://cdn.firebase.com/js/client/2.3.2/firebase.js"></script>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript">

//ADMIN PAGE IS SUBMITTING ON REFRESH, MUST ONLY FIRE WHEN BUTTON IS PRESSED

//paths to firebase which will get deleted for a new game
var imagesRef = new Firebase("https://incandescent-heat-4986.firebaseio.com/images/");
var usersRef = new Firebase("https://incandescent-heat-4986.firebaseio.com/users/");
var storyRef = new Firebase("https://incandescent-heat-4986.firebaseio.com/storykey/");
var finishedRef = new Firebase("https://incandescent-heat-4986.firebaseio.com/FinalVotesCollected/");


imagesRef.remove(); //wipe all children of images/
usersRef.remove(); //wipe all children of users/
storyRef.remove(); //wipe story key/
finishedRef.remove(); 


var gamekey = new Firebase("https://incandescent-heat-4986.firebaseio.com/gamekey/"); 
gamekey.transaction(function (current_value) {
                             return (current_value || 0) + 1;
});

var storykey = new Firebase("https://incandescent-heat-4986.firebaseio.com/storykey/"); 
storykey.transaction(function (current_value) {
    //return a random number between 1 and 3 to pick a story for the next game
                            return Math.floor(Math.random() * (3 - 1 + 1)) + 1;
});
</script>
</head>

<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
?>

<form action="admin.php" method="post" enctype="multipart/form-data">

 <br/>
 <input type="submit" value="Reset Game - All files will be deleted!"/>

</form>

<?php
}
    else if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);

    $files = glob('uploads/*'); //find all files in uploads
        foreach($files as $file){ //iterate files
            $fileType = exif_imagetype($file);

            if(is_file($file) && in_array($fileType, $allowed))
            unlink($file); //deletes files
        }

    $files = glob('selfies/*'); //find all files in selfies
        foreach($files as $file){ //iterate files
            $fileType = exif_imagetype($file);

            if(is_file($file) && in_array($fileType, $allowed))
            unlink($file); //deletes files
        }

    }
?>



<div id = "done" style="display: none">

    <a href="Voting.html">All gone!</a>
</div>

</body>
</html>


