<?php


include("include.php");
$kapcs=mysqli_connect($bhost,$buser,$bpasswd);
mysqli_select_db($kapcs,"bidwebpagedatabase");

$itemid = $_GET['itemid'];

$sql = "SELECT `item`.`Title`, `bid`.`BidPrice`, `item`.`StartingPrice`, `item`.`EndDate`, `item`.`StartDate`, `item`.`Description`, `item`.`Picture`
            FROM `item`
            LEFT JOIN `bid` ON `bid`.`Item_ID` = `item`.`Item_ID`
            WHERE  `item`.`Item_ID`='$itemid'";

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
      <a class="navbar-brand" href="index.php">B-Tech Vatera</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Főoldal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Regisztráció</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Bejelentkezés</a>
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
              <div class="bid_login font-weight-bold float-right">A licitáláshoz be kell jelentkeznie.
              <a href="login.php">Bejelentkezés</a></div>
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
