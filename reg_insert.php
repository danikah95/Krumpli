<?php
    include ("include.php");
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
        echo "Sikeres regisztráció!";

    }
    else 
        echo "A két jelszó nem egyezik";
            

?>

<FORM action="register.php">

</FORM>