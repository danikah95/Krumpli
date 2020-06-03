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
    
    $sessionEmail = $_SESSION["EMail"];

    $sql = "SELECT AdminCheck FROM registeredusers WHERE EMail like " . '"' . $sessionEmail . '"' . ";";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $AdminCheck = $row["AdminCheck"];
    }
    

    if ($AdminCheck != 1)
    {
        fun_alert ("Nincs admin jogosultsága!", "loggedIn_index.php");
    }

    else 
    {
        $Item_ID = $_GET['Item_ID'];

        $sql = "DELETE FROM item WHERE Item_ID  = '$Item_ID';";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
	
	    fun_alert ("Sikeres törlés!", "admin_item.php");
    }
    
    mysqli_close($conn);
	
    
}
else
{
    fun_alert ("Nincs bejelentkezve!", "login.php");
}

?>