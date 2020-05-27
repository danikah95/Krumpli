<head>
    <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/customcss-homepage.css" rel="stylesheet">
</head>


<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
    include ("include.php");
    include ("alert_insert.php");
    $db = mysqli_connect($bhost,$buser,$bpasswd);

    $lastname = ($_POST['Lastname']);
    $firstname = ($_POST['Firstname']);
    $email = ($_POST['EMail']);
    $address = ($_POST['Address']);
    $phone = ($_POST['Phonenumber']);
    $password = ($_POST['UserPassword']);
    $password2 = ($_POST['UserPassword2']);


	mysqli_select_db($db,'bidwebpagedatabase');
  if ($password == $password2)
	{
    $password = md5($password); //hashing password
    $sql = "INSERT into registeredusers VALUES('','$lastname','$firstname','$email','$address','$phone','$password','')";
    mysqli_query($db, $sql);
    //echo "Sikeres regisztráció!";
		fun_alert ("Sikeres regisztráció!", "index.php");
  }
  else
	{
    //echo "A két jelszó nem egyezik";
		fun_alert ("A két jelszó nem egyezik!", "register.php");
	}

?>
  <!-- /.container -->


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>


<FORM action="register.php">

</FORM>