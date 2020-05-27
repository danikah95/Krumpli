<?php
	include ("alert_insert.php");
	session_start();
	if(isset($_SESSION["bTechLoggedIn"]) && $_SESSION["bTechLoggedIn"] == true)
	{
		
		include ("include.php");
		$conn = mysqli_connect($bhost,$buser,$bpasswd,$dbname);
	
		if (!$conn)
		{
			die("Connection failed: " . mysqli_connect_error());
		}
		
		if(isset($_POST['bid_btn']))
		{
			$amount = ($_POST['Amount']);
			$tempItemID = ($_GET['Item_ID']);
			$tempStartingPrice = 0.0;
			
			$sql = "SELECT StartingPrice FROM Item where Item_ID = '$tempItemID';";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_assoc($result))
			{
				$tempStartingPrice = $row['StartingPrice'];
			}
			
			if ($amount >= ($tempStartingPrice * 0.1))
			{
				$sessionEmail = $_SESSION["EMail"];
				$db = 0;
				$sql = "SELECT COUNT(*) as Number FROM Bid where Item_ID = '$tempItemID';";
				$result = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_assoc($result))
				{
					$db = $row['Number'];
				}
				
				if ($db == 0)
				{
					//insert into Bid
					$sql = "SELECT User_ID FROM registeredusers WHERE EMail like " . '"' . $sessionEmail . '"' . ";";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$UserID = $row["User_ID"];
					
					$finalBid = $tempStartingPrice + $amount;
					
					$sql = "INSERT INTO Bid (BidPrice, User_ID, Item_ID) VALUES ('$finalBid', '$UserID', '$tempItemID');";
					mysqli_query($conn, $sql);

					fun_alert ("Sikeres licitálás!", "loggedIn_itempage.php?Item_ID=$tempItemID");
				}
				else
				{
					//update Bid
					$sql = "SELECT User_ID FROM registeredusers WHERE EMail like " . '"' . $sessionEmail . '"' . ";";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$UserID = $row["User_ID"];
					
					$sql = "SELECT BidPrice FROM Bid WHERE Item_ID = '$tempItemID';";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$BidPrice = $row["BidPrice"];
					
					$finalBid = $BidPrice + $amount;
					
					$sql = "UPDATE Bid SET BidPrice = '$finalBid', User_ID = '$UserID' WHERE Item_ID = '$tempItemID';";
					mysqli_query($conn, $sql);
					
					fun_alert ("Sikeres licitálás!", "loggedIn_itempage.php?Item_ID=$tempItemID");
				}
			}
			else
			{
				//alert, hogy nem jo
				fun_alert ("Túl kicsi az összeg! Minimum: " . ($tempStartingPrice * 0.1) . "Ft", "loggedIn_itempage.php?Item_ID=$tempItemID");
			}
		}
		
		mysqli_close($conn);
	}
	else
	{
		fun_alert ("Nincs bejelentkezve!", "login.php");
	}
?>