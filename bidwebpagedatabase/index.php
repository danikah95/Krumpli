<?php
include ("include.php");
$link = mysqli_connect($bhost, $buser, $bpasswd);

//kapcsolat ellenőrzése
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//adatbázis
if ($result = mysqli_query($link, "SELECT DATABASE ()")) {
    $row = mysqli_fetch_row($result);
    mysqli_free_result($result);
}

mysqli_select_db($link, "bidwebpagedatabase");
if ($result = mysqli_query($link, "SELECT DATABASE()")) {
    $row = mysqli_fetch_row($result);
    mysqli_free_result($result);
}

//hirdetések lekérdezése
$item=mysqli_query($link, "SELECT `item`.*, `pictures`.`Pic1`, `bid`.`BidPrice`
                           FROM `item`
                           LEFT JOIN `pictures` ON `pictures`.`Item_ID` = `item`.`Item_ID`
                           LEFT JOIN `bid` ON `bid`.`Item_ID` = `item`.`Item_ID`;");
$sorok=mysqli_num_rows($item);
if ($sorok==0) 
{
  echo '<br>Nincs meghirdetett termék<br>';exit;
}
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
    $User_ID [$i]=$adatok[7];
    $Pic1[$i]=$adatok[8];
    $BidPrice[$i]=$adatok[9];
    $i++;
}

?>

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
      <a class="navbar-brand" href="index.php">B-Tech Vatera</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Főoldal
            </a>
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
  <div class="container">

    <div class="row">

      <div class="col-lg-3">
        <div class="list-group">

        
          <!-- dropdown menü -->
          <div class="dropdown list-group-item">
            <button class="btn btn-info dropdown-toggle w-100" type="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Kategóriák
            </button>
            <div class="dropdown-menu w-100" aria-labelledby="dropdownMenu4">
              <a class="dropdown-item" href="#">kat1</a>
              <a class="dropdown-item" href="#">kat2</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">kat3</a>
            </div>
          </div>
          <!-- /.dropdown menü -->

          <!-- keresés -->
          <form class="form-inline md-form mr-auto mb-4 w-100 list-group-item">
            <input class="form-control mr-sm-2 w-100 " type="text" placeholder="Mit keres?" aria-label="Search">
            <button class="btn btn-info btn-block btn-md" type="submit">Keresés</button>
          </form>
          <!-- /.keresés -->
        </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div class="row">
          
        
        <?php
            //összes feladott hirdetés
            for ($i = 0; $i < $sorok; $i++)
            {
                echo '<div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="'.$Pic1[$i].'" alt=""></a>
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

</body>

</html>
