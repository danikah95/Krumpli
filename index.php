<?php
include ("include.php");
$link = mysqli_connect($bhost, $buser, $bpasswd);

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
$item=mysqli_query($link, "SELECT `item`.*, `bid`.`BidPrice`
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
}


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
  <div class="container">

    <div class="row">

      <div class="col-lg-3">


          <!-- dropdown menü -->
		<form method="post">
		  <select class="selectpicker form-control" id="Fokategoria" name="FokategoriaLista" required>
  			      <option value="" disabled selected>Kategóriák</option>
  			      <option value="jarmu">Jármű</option>
				      <option value="muszakiCikkek">Műszaki cikkek</option>
				      <option value="szabadidoSport">Szabadidő, sport</option>
				      <option value="ruhazat">Ruházat</option>
				      <option value="otthonHaztartas">Otthon, háztartás</option>
		        </select>
           <!--/.dropdown menü -->
		
          <!-- keresés -->
          <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Mit keres?" aria-label="Mit keres?" aria-describedby="basic-addon2">
            <div class="input-group-append">
            <button class="btn btn-info btn-block btn-sm" type="submit" name="search_btn">Keresés</button>
          </div>
		  
          <!-- /.keresés -->
      </div>
    </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div class="row">
          
        
        <?php
			
			
			if (mysqli_num_rows($search_result) == 0) { 
				 echo 'Nincs ilyen meghirdetett termék';
			}
			else
			{
				while($row = mysqli_fetch_array($search_result))
				{
				echo '<div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="Pictures/'.$row['Picture'].'" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">'.$row['Title'].'</a>
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

            if ($sorok == 0) {
              echo 'Nincs meghirdetett termék';
            }
/*
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
