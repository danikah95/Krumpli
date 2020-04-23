<?php
	include ("include.php");
// Create connection
	$conn = mysqli_connect($bhost, $buser, $bpasswd, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

  $email = ($_POST['EMail']);
	$password = ($_POST['UserPassword']);
	$hpw=md5($password);


	$sql = "SELECT UserPassword FROM registeredusers WHERE EMail='$email'";
	$result = mysqli_query($conn, $sql);
?>


<head>
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




  <?php

    if (mysqli_num_rows($result) > 0) 
    {
    // output data of each row
        while($row = mysqli_fetch_assoc($result))
        {
		    if($hpw == $row["UserPassword"])
		    {
                echo
                '<div class="alert alert-success text-center" role="alert">
                    Sikeres bejelentkezés!
                </div>';
			    //header('Location: search.php');
		    }
		    else
		    {
                echo
                '<div class="alert alert-danger text-center" role="alert">
                    Sikertelen bejelentkezés
                </div>';
		    }
        }
    }
    else 
    {
        echo "0 results";
    }

mysqli_close($conn);

?>
  <!-- /.container -->


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>


<FORM action="register.php">

</FORM>