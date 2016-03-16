<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://cdn.firebase.com/js/client/2.3.2/firebase.js"></script>
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

</head>
<body>
	<h1>Welcome to Mad Pic!</h1>

	<?php
	define("UPLOAD_DIR", "selfies/");
	//show upload form
	//if ($_SERVER["REQUEST_METHOD"] == "GET") {
	?>
	<form action="GameStart.php" method="post" enctype="multipart/form-data">

		<?php 
		if( isset($_SESSION['userName']))
		{
			echo 'Welcome Back '.$_SESSION['userName'].'<br />';

		}
		else
		{
			?>
			Please enter your username <br />
			<input type="text" name="username" value="<?php echo ($_SESSION['userName']!='' ? $_SESSION['userName'] : ''); ?>" placeholder="Type in your User Name" />
			<?php 
		}
		?>
		
		<input type="file" name="selfie"/>
		<br/>
		<input type="submit" value="Upload"/>
	</form>

	<?php
	//}
// process file upload
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$myFile = $_FILES["selfie"];
		
		if(!isset($_SESSION['userName']))
		{
			$userName = $_POST["username"];
			$_SESSION["userName"] = $userName;
		}
		else{
			$userName = $_SESSION["userName"];
		}

		//*** Todo: Figure out why cookies is not saving/reading
		

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
		echo "<p>Your User Name is " . $_SESSION["userName"] . ".</p>";
		echo "<p>Uploaded selfie saved as " . $name . ".</p>";
		echo "<br><p><a href='uploader2.php'>Play!</a></p>";

		?> 


	<script type="text/javascript">

	  //save values to fb
	  //*** Todo: Figure out why this variable is not getting populated from inside of snapshot function. Must get userNames.set to wait for results from userCount.once
	  var nextPlayer = 0;
	  var userCount = new Firebase("https://incandescent-heat-4986.firebaseio.com/users");
	  var userNames = new Firebase("https://incandescent-heat-4986.firebaseio.com/users/<?php echo $userName ?>");

	  userCount.once("value", function(snapshot) {
	  	nextPlayer = snapshot.numChildren() + 1;
	  	console.log("NP: " + nextPlayer);

	  	userNames.set({
	  		selfieName: "<?php echo $name ?>",
	  		playernum: nextPlayer
	  	});
	  });


</script>

<? 	} //Close ElseIf Tag  ?>
</body>
</html>