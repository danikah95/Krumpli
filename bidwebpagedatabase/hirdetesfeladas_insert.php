<?php
	include ("alert_insert.php");
	session_start();
	if(isset($_SESSION["bTechLoggedIn"]) && $_SESSION["bTechLoggedIn"] == true)
	{
	$sessionEmail = $_SESSION["EMail"];
		
    include ("include.php");
    $conn = mysqli_connect($bhost,$buser,$bpasswd,$dbname);
	
	if (!$conn)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	
    $Title = ($_POST['Title']);
    $Price = ($_POST['Price']);
    $Description = ($_POST['Description']);
    $FokategoriaLista = ($_POST['FokategoriaLista']);
	
	$target_dir = "Pictures/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"]))
	{
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false)
		{
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		}
		else
		{
			//echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 1000000)
	{
		//echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
	{
		//echo "Sorry, only JPG, JPEG and PNG files are allowed.";
		$uploadOk = 0;
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0)
	{
		//echo "Sorry, your file was not uploaded.";
		fun_alert ("A képet nem sikerült feltölteni", "hirdetesfeladas.php");
	// if everything is ok, try to upload file
	}
	else
	{
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
		{
			$picname = basename( $_FILES["fileToUpload"]["name"]);
			$startdate = date("Y-m-d");
			$d = strtotime("+4 weeks");
			$enddate = date("Y-m-d", $d);
			$sql = "SELECT User_ID FROM registeredusers WHERE EMail like " . '"' . $sessionEmail . '"' . ";";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$finalUserID = $row["User_ID"];
			$sql = "INSERT INTO item (StartDate, EndDate, StartingPrice, Title, Description, Category, Picture, User_ID) VALUES ('$startdate', '$enddate', $Price, '$Title', '$Description', '$FokategoriaLista', '$picname', $finalUserID);";
			$result = mysqli_query($conn, $sql);
			if($result == 1)
			{
				//echo "Sikeres hirdetésfeladás!";
				fun_alert ("Sikeres hirdetésfeladás!", "loggedIn_index.php");
			}
			else
			{
				//echo "Sikertelen hirdetésfeladás!";
				unlink($target_file);
				fun_alert ("Sikertelen hirdetésfeladás!", "hirdetesfeladas.php");
			}
		}
		else
		{
			//echo "Sorry, there was an error uploading your file.";
			fun_alert ("A képet nem sikerült feltölteni", "hirdetesfeladas.php");
		}
	}
	
	mysqli_close($conn);
	}
	else
	{
		fun_alert ("Nincs bejelentkezve!", "login.php");
	}
?>