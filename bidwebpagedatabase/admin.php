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
    
        mysqli_close($conn);
}
else
{
    fun_alert ("Nincs bejelentkezve!", "login.php");
}

//usercount
$usercount = "SELECT COUNT(User_ID) FROM registeredusers";
$u_result = mysqli_query($link,$usercount);
$u_check = mysqli_num_rows($u_result);
$u_row=mysqli_fetch_assoc($u_result);

//itemcount
$itemcount = "SELECT COUNT(Item_ID) FROM item";
$i_result = mysqli_query($link,$itemcount);
$i_check = mysqli_num_rows($i_result);
$i_row=mysqli_fetch_assoc($i_result);

//bidcount
$bidcount = "SELECT COUNT(Bid_ID) FROM bid";
$b_result = mysqli_query($link,$bidcount);
$b_check = mysqli_num_rows($b_result);
$b_row=mysqli_fetch_assoc($b_result);

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

      <!-- /.col-lg-3 -->

      <div class="col-lg-12">


    <div class="container-fluid">
        <div class="card-deck">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                <?php echo'
                    <h2 class="font-weight-bold mb-2">
                    <svg class="bi bi-person-lines-fill" width="3em" height="3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7 1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm2 9a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                    </svg><br>
                    Felhasználók
                    </h2>  
                    <h4 class="mb-2">Összesen: '.$u_row['COUNT(User_ID)'].' db</h4>
                    <a href="admin_user.php" class="stretched-link"></a>';
                    ?>
                </div>
            </div>


            <div class="card bg-gradient-info  card-img-holder text-white">
                <div class="card-body">
                <?php echo'
                    <h2 class="font-weight-bold mb-2">
                    <svg class="bi bi-cart4" width="3em" height="3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                    </svg><br>
                    Termékek
                    </h2>  
                    <h4 class="mb-2">Összesen: '.$i_row['COUNT(Item_ID)'].' db</h4>
                    <a href="admin_item.php" class="stretched-link"></a>';
                    ?>
                </div>
            </div>

            
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
