<?php
include ("alert_insert.php");
include ("include.php");

session_start();
if(isset($_SESSION["bTechLoggedIn"]) && $_SESSION["bTechLoggedIn"] == true)
{
    $conn = mysqli_connect($bhost, $buser, $bpasswd, $dbname);
    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    
	$SoldItem_ID = $_GET['SoldItem_ID'];
	
    $sql = "DELETE FROM SoldItems WHERE SoldItem_ID = '$SoldItem_ID';";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
	
	fun_alert ("Sikeres törlés!", "solditemlist.php");
}
else
{
    fun_alert ("Nincs bejelentkezve!", "login.php");
}

?>