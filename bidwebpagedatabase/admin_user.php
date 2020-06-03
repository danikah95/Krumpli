<?php
include ("include.php");
include ("alert_insert.php");
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

//bejelentkezés check
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

        if ($AdminCheck != 1)
        {
          fun_alert ("Nincs admin jogosultsága!", "loggedIn_index.php");
        }

        //userek
        $sql = "SELECT User_ID,Lastname,Firstname,EMail,Address,Phonenumber,UserPassword,AdminCheck
                FROM registeredusers";
        $result = mysqli_query($link, $sql);
        $sorok = mysqli_num_rows($result);
  
        $i=0;
  
        while ($adatok=mysqli_fetch_assoc($result))
        {
		      $User_ID[$i] = $adatok['User_ID'];
          $Lastname2[$i] = $adatok['Lastname'];
          $Firstname2[$i] = $adatok['Firstname'];
		      $EMail[$i] = $adatok['EMail'];
		      $Address[$i] = $adatok['Address'];
		      $Phonenumber[$i] = $adatok['Phonenumber'];
          $UserPassword[$i] = $adatok['UserPassword'];
          $AdminCheck[$i] = $adatok['AdminCheck'];
    
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
  <link rel="stylesheet" href="css/style.css">
  <link href="css/customcss-homepage.css" rel="stylesheet">
  

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
    <div class="container">
      <a class="navbar-brand" href="admin.php">B-Tech Vatera (admin)</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="admin.php">Főoldal</a>
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

    <div class="col-lg-12">
    <?php
  
  if ($sorok == 0)
	{
		echo'<h5 class="text-center">Még nincs regisztrált felhasználó</p>';
	}

    echo'<div class="container-fluid">
    <div class="table-responsive-sm">
    <table class="table table-striped">
    <thead class="bg-info text-white">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Vezetéknév</th>
            <th scope="col">Keresztnév</th>
            <th scope="col">E-mail</th>
            <th scope="col">Lakcím</th>
            <th scope="col">Telefonszám</th>
            <th scope="col">Törlés</th>
        </tr>
    </thead>
    <tbody>';

    
	for ($i = 0; $i < $sorok; $i++)
	{
      echo '<tr>
                <th scope="row">'.$User_ID[$i].'</th>
                <td>'.$Lastname2[$i].'</td>
                <td>'.$Firstname2[$i].'</td>
                <td>'.$EMail[$i].'</td>
                <td>'.$Address[$i].'</td>
                <td>'.$Phonenumber[$i].'</td>

                <td>
                <form action="user_delete.php?User_ID='.$User_ID[$i].'" method="POST">
                    <button type="submit" class="btn btn-sm btn-round text-dark">
                        <svg class="bi bi-x-square-fill" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm9.854 4.854a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/></svg>
                    </button>
                </form>
                </td>
            </tr>';
    }
    echo'</tbody>
    </table>';
    
    ?>
    </div>
    </div>

          
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
