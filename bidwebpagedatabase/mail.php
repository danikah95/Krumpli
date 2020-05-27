<?php
	include ("include.php");
	$conn = mysqli_connect($bhost,$buser,$bpasswd,$dbname);
	
	if (!$conn)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$EMail_Array = array();
	$to = "";
	$i = 0;
	
	$sql = "SELECT EMail FROM registeredusers;";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result))
	{
		$EMail_Array[$i] = $row["EMail"];
		$i++;
	}
	
	$arrlength = count($EMail_Array);

	for($x = 0; $x < $arrlength; $x++)
	{
		if($x == ($arrlength - 1))
		{
			$to .= $EMail_Array[$x];
		}
		else
		{
			$to .= $EMail_Array[$x] . ", ";
		}
	}
	
	//echo $EMail;
	
	$subject = "B-Tech Vatera körlevél";
	$txt = "Ne maradjon le a legújabb ajánlatainkról!\r\nLátogasson el a weboldalunkra és nézze meg a legfrissebb ajánlatainkat!\r\nÜdvözlettel: A B-Tech Vatera csapata!";
	$headers = "From: noreply@btechvatera.com";
	$message = wordwrap($txt, 70, "\r\n");

	//mail($to,$subject,$txt,$headers);
	
	mysqli_close($conn);
?>