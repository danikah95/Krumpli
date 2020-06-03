<?php
	include ("alert_insert.php");
	include ("include.php");
	$link = mysqli_connect($bhost, $buser, $bpasswd);

	session_start();
	if(isset($_SESSION["bTechLoggedIn"]) && $_SESSION["bTechLoggedIn"] == true)
	{
		include ("include.php");
		$conn = mysqli_connect($bhost, $buser, $bpasswd, $dbname);
		if (!$conn)
		{
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$sessionEmail = $_SESSION["EMail"];
		$Lastname = $Firstname = "";
		
		$sql = "SELECT Lastname, Firstname FROM registeredusers WHERE EMail like " . '"' . $sessionEmail . '"' . ";";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result))
		{
			$Lastname = $row["Lastname"];
			$Firstname = $row["Firstname"];
		}
		
		$FullName = $Lastname . " " . $Firstname;
		
		mysqli_close($conn);
	}
	else
	{
		fun_alert ("Nincs bejelentkezve!", "login.php");
	}


//kapcsolat ellenőrzése
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//adatbázis
mysqli_select_db($link, "bidwebpagedatabase");
if ($result = mysqli_query($link, "SELECT DATABASE()")) {
    $row = mysqli_fetch_row($result);
    mysqli_free_result($result);
}

//hirdetések lekérdezése
/*$item=mysqli_query($link, "SELECT `item`.*, `bid`.`BidPrice`
                           FROM `item`
                           LEFT JOIN `bid` ON `bid`.`Item_ID` = `item`.`Item_ID`;");
$sorok=mysqli_num_rows($item);

$i=0;

//lekérdezés attribútumai
while ($adatok=mysqli_fetch_array($item))
{ 
    $Item_ID [$i]=$adatok[0];
    $StartDate[$i]=$adatok[1];
    $EndDate[$i]=$adatok[2];
    $StartingPrice[$i]=$adatok[3];
    $Title[$i]=$adatok[4];
    $Description[$i]=$adatok[5];
    $Category[$i]=$adatok[6];
    $Picture[$i]="Pictures/".$adatok[7];
    $User_ID [$i]=$adatok[8];
    $BidPrice[$i]=$adatok[9];
    $i++;
}*/

//SAJÁT RÉSZ------------------------------
/*$sql = "SELECT Item_ID, EndDate, StartingPrice, Title, User_ID FROM Item WHERE enddate < NOW();";
$result = mysqli_query($link, $sql);
while($row = mysqli_fetch_assoc($result))
{
	$soldItem_ItemID = $row['Item_ID'];
	$soldItem_EndDate = $row['EndDate'];
	$soldItem_StartingPrice = $row['StartingPrice'];
	$soldItem_Title = $row['Title'];
	$soldItem_UserID = $row['User_ID'];
	
	$sql_in = "SELECT COUNT(*) as db, b.BidPrice, ru.Lastname, ru.Firstname, ru.EMail FROM bid b join registeredusers ru on b.User_ID = ru.User_ID WHERE Item_ID = '$soldItem_ItemID';";
	$result_in = mysqli_query($link, $sql_in);
	while($row_in = mysqli_fetch_assoc($result_in))
	{
		$checkBid = $row_in['db'];
		$buyer_Price = $row_in['BidPrice'];
		$buyer_Name = $row_in['Lastname'] . " " . $row_in['Firstname'];
		$buyer_EMail = $row_in['EMail'];
	}
	
	if ($checkBid > 0)
	{
		$sql_in = "INSERT INTO SoldItems (Seller_UserID, Seller_SoldItemName, Seller_SoldItemStartingPrice, Buyer_BidPrice, Buyer_EMail, Buyer_Name, Seller_AuctionEndDate) VALUES ('$soldItem_UserID', '$soldItem_Title', '$soldItem_StartingPrice', '$buyer_Price', '$buyer_EMail', '$buyer_Name', '$soldItem_EndDate');";
		mysqli_query($link, $sql_in);
	}
	else
	{
		$sql_in = "INSERT INTO SoldItems (Seller_UserID, Seller_SoldItemName, Seller_SoldItemStartingPrice, Buyer_BidPrice, Buyer_EMail, Buyer_Name, Seller_AuctionEndDate) VALUES ('$soldItem_UserID', '$soldItem_Title', '$soldItem_StartingPrice', 0, ".'"'."-".'"'.", ".'"'."-".'"'.", '$soldItem_EndDate');";
		mysqli_query($link, $sql_in);
	}
}
//EDDIG------------------------------

//lejárt hirdetések
$sql = "DELETE FROM item WHERE enddate < NOW();";
$link->query($sql);

//keresés
if(isset($_POST['search_btn']))
			{
				$valueToSearch = $_POST['search'];
				$category=$_POST['FokategoriaLista'];
				$query = "SELECT `item`.*, `bid`.`BidPrice`
                           FROM `item`
                           LEFT JOIN `bid` ON `bid`.`Item_ID` = `item`.`Item_ID` WHERE ((Category LIKE '%".$category."%') AND (Title LIKE '%".$valueToSearch."%'))";
				$search_result = filterTable($query);
    
			}
			else {
				$query = "SELECT `item`.*, `bid`.`BidPrice`
                           FROM `item`
                           LEFT JOIN `bid` ON `bid`.`Item_ID` = `item`.`Item_ID`";
				$search_result = filterTable($query);
			}

			function filterTable($query)
			{
				$connect = mysqli_connect("localhost", "root", "", "bidwebpagedatabase");
				$filter_Result = mysqli_query($connect, $query);
				return $filter_Result;
			}


*/

if(isset($_POST['next_btn']))
{
	fun_alert("Köszöntünk az oldalon","loggedIn_index.php");
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
  <link href="css/customcss-homepage.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
    <div class="container">
      <a class="navbar-brand" href="hirlevel.php">B-Tech Vatera</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          
		  <li class="nav-item">
            <a class="nav-link" href="solditemlist.php">Eladott termékek</a>
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
  <div class="container">
  
		<h2 align='center'>Tekintse meg kínálatunk</h2>
		
		<form method="post" >
		<button class="btn btn-info btn-block btn-sm" type="submit" name="next_btn">Tovább az oldalra</button>
		</form>

    <div class="row">
		
		
		

      <div class="col-lg-3">

        
         <!-- dropdown menü 
		 
		 <form method="post">
         <select class="selectpicker form-control" id="Fokategoria" name="FokategoriaLista" required>
  			      <option value="" disabled selected>Kategóriák</option>
  			      <option value="jarmu">Jármű</option>
				      <option value="muszakiCikkek">Műszaki cikkek</option>
				      <option value="szabadidoSport">Szabadidő, sport</option>
				      <option value="ruhazat">Ruházat</option>
				      <option value="otthonHaztartas">Otthon, háztartás</option>
		        </select>
		-->

          <!-- keresés 
          <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Mit keres?" aria-label="Mit keres?" aria-describedby="basic-addon2">
            <div class="input-group-append">
            <button class="btn btn-info btn-block btn-sm" type="submit" name="search_btn">Keresés</button>
          </div>

		-->
        </div>
		
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div class="row">
		
          
        
        <?php
		
		$query="SELECT `Item`.*, `bid`.`BidPrice`FROM `item` LEFT JOIN `bid` ON `bid`.`Item_ID` = `item`.`Item_ID` ORDER BY `EndDate` LIMIT 3";
		
		$results = filterTable($query);
		
		function filterTable($query)
			{
				$connect = mysqli_connect("localhost", "root", "", "bidwebpagedatabase");
				$filter_Result = mysqli_query($connect, $query);
				return $filter_Result;
			}
		
		if (mysqli_num_rows($results) == 0) { 
				 echo 'Nincs ilyen meghirdetett termék';
			}
			else
			{
				while($row = mysqli_fetch_array($results))
				{
				echo '<div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-justify h-100">
                    <a href="loggedIn_itempage.php?Item_ID='.$row['Item_ID'].'"><img class="card-img-top" src="Pictures/'.$row['Picture'].'" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title text-center">
                              <a href="loggedIn_itempage.php?Item_ID='.$row['Item_ID'].'">'.$row['Title'].'</a>
                            </h4>
                            <h5>Jelenlegi licit: '.$row['BidPrice'].' Ft</h5>
                            <h6>Kezdő ár: '.$row['StartingPrice'].' Ft</h6>
                            <p class="card-text">'.$row['Description'].'</p>
                        </div>
                    </div>
                </div>';
				}
			}
            //összes feladott hirdetés
			/*
            if ($sorok == 0) {
              echo 'Nincs meghirdetett termék';
            }
			
            for ($i = 0; $i < $sorok; $i++)
            {
                echo '<div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="'.$Picture[$i].'" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">'.$Title[$i].'</a>
                            </h4>
                            <h5>Jelenlegi licit: '.$BidPrice[$i].' Ft</h5>
                            <h6>Kezdő ár: '.$StartingPrice[$i].' Ft</h6>
                            <p class="card-text">'.$Description[$i].'</p>
                        </div>
                    </div>
                </div>';
            }
            */
            ?>
          
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</form>
</body>

</html>