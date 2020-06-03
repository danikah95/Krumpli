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
    $Lastname = $Firstname = "";
    
    $sql = "SELECT Lastname, Firstname, User_ID FROM registeredusers WHERE EMail like " . '"' . $sessionEmail . '"' . ";";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $Lastname = $row["Lastname"];
        $Firstname = $row["Firstname"];
		$UserID = $row['User_ID'];
    }
    
    $FullName = $Lastname . " " . $Firstname;
	
	$sql = "SELECT SoldItem_ID, Seller_SoldItemName, Seller_SoldItemStartingPrice, Buyer_BidPrice, Buyer_EMail, Buyer_Name, Seller_AuctionEndDate FROM SoldItems WHERE Seller_UserID = '$UserID';";
    $result = mysqli_query($conn, $sql);
	$sorok = mysqli_num_rows($result);
	$i=0;
    while($row = mysqli_fetch_assoc($result))
    {
		$SoldItemID[$i] = $row["SoldItem_ID"];
        $Seller_SoldItemName[$i] = $row["Seller_SoldItemName"];
        $Seller_SoldItemStartingPrice[$i] = $row["Seller_SoldItemStartingPrice"];
		$Buyer_BidPrice[$i] = $row['Buyer_BidPrice'];
		$Buyer_EMail[$i] = $row['Buyer_EMail'];
		$Buyer_Name[$i] = $row['Buyer_Name'];
		$Seller_AuctionEndDate[$i] = $row['Seller_AuctionEndDate'];
		$i++;
    }
	
    mysqli_close($conn);
}
else
{
    fun_alert ("Nincs bejelentkezve!", "login.php");
}

?>

<!DOCTYPE html>
<html lang="hu">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>B-Tech Vatera</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-item.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
    <div class="container">
      <a class="navbar-brand" href="loggedIn_index.php">B-Tech Vatera</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="loggedIn_index.php">Főoldal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="hirdetesfeladas.php">Hirdetésfeladás</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kijelentkezes.php">Kijelentkezés</a>
          </li>
          <li class="nav-item">
            <span class="navbar-text font-weight-bold" id="user_name"><?php echo "Üdv " . $FullName . "!";?></span>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <!--<div class="container">-->
  <div class="row">
  <div class="col-lg-9">
  <div class="row">
  <?php
	if ($sorok == 0)
	{
		echo 'Jelenleg nincs eladott terméke';
	}
	for ($i = 0; $i < $sorok; $i++)
	{
		echo '<div class="col-lg-4 col-md-6 mb-4">
				<div class="card text-justify h-100">
					<div class="card-body">
						<p class="card-text">Termék neve: '.$Seller_SoldItemName[$i].'</p>
						<p class="card-text">Termék kezdőára: '.$Seller_SoldItemStartingPrice[$i].'Ft</p>
						<p class="card-text">Legmagasabb licit: '.$Buyer_BidPrice[$i].'Ft</p>
						<p class="card-text">Vevő e-mail címe: '.$Buyer_EMail[$i].'</p>
						<p class="card-text">Vevő neve: '.$Buyer_Name[$i].'</p>
						<p class="card-text">Aukció vége: '.$Seller_AuctionEndDate[$i].'</p>
						
						<form action="deletesolditem.php?SoldItem_ID='.$SoldItemID[$i].'" method="POST">
							<div class="input-group w-50 float-right">
								<div class="input-group-append">
									<button type="submit" class="btn btn-info float-right" name="del_btn">Adatok törlése</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>';
	}
  ?>
  <!--</div>-->
  </div>
  </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>