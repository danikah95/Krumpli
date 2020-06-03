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
    
    $sql = "SELECT Lastname, Firstname, AdminCheck FROM registeredusers WHERE EMail like " . '"' . $sessionEmail . '"' . ";";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            $Lastname = $row["Lastname"];
            $Firstname = $row["Firstname"];
            $AdminCheck = $row["AdminCheck"];
        }
        $FullName = $Lastname . " " . $Firstname;
        if ($AdminCheck == 1)
        {
          header('Location: admin.php');
        }
		mysqli_close($conn);
}
else
{
    fun_alert ("Nincs bejelentkezve!", "login.php");
}

include("include.php");
$kapcs=mysqli_connect($bhost,$buser,$bpasswd);
mysqli_select_db($kapcs,"bidwebpagedatabase");

$Item_ID = $_GET['Item_ID'];

$sql = "SELECT `item`.`Title`, `bid`.`BidPrice`, `item`.`StartingPrice`, `item`.`EndDate`, `item`.`StartDate`, `item`.`Description`, `item`.`Picture`
            FROM `item`
            LEFT JOIN `bid` ON `bid`.`Item_ID` = `item`.`Item_ID`
            WHERE  `item`.`Item_ID`='$Item_ID'";

$result = mysqli_query($kapcs,$sql);

$check = mysqli_num_rows($result);
$row=mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">

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
  <?php
      
      echo'
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="card mt-4">
              <img class="card-img-top" src="Pictures/'.$row['Picture'].'" alt="">
            </div>
          </div>
        <!-- /.col-lg-3 -->
  
        <div class="col-lg-7">
  
          <div class="card mt-4">
            
            <div class="card-body">
              <h3 class="card-title text-info">'.$row['Title'].'</h3>
              <h4 class="font-weight-bold">Jelenlegi licit: '.$row['BidPrice'].' Ft</h4>
              <h5>Kezdő ár: '.$row['StartingPrice'].' Ft</h4>
              <h6>Az aukció vége: '.$row['EndDate'].' </h4>
              <h6>Aukció kezdete: '.$row['StartDate'].'</h4>
              <p class="card-text">'.$row['Description'].'</p>

              <form action="bid.php?Item_ID='.$Item_ID.'" method="POST">
                <div class="input-group w-50 float-right">
                  <input type="number" class="form-control" name="Amount" placeholder="Ár" required="required">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-info float-right" name="bid_btn">Licitálok</button>
                    </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.card -->
  
        </div>
        <!-- /.col-lg-9 -->
  
      </div>
  
    </div>
    <!-- /.container -->';
      

  ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
