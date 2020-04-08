<?php
	include ("include.php");
// Create connection
	$conn = mysqli_connect($bhost, $buser, $bpasswd, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

    $email = ($_POST['EMail']);
	$password = ($_POST['UserPassword']);
	$hpw=md5($password);


	$sql = "SELECT UserPassword FROM registeredusers WHERE EMail='$email'";
	$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		if($hpw == $row["UserPassword"])
		{
			echo "Sikeres bejelentkezés<br>";
		}
		else
		{
			echo "Sikertelen bejelentkezés<br>";
		}
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>

<FORM action="login.php">

</FORM>