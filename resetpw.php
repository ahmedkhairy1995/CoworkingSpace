<?php
 function redirect_to ($newlocation)
 {
	header("Location:".$newlocation);
	exit;
 }
//connecting to database

    $dbhost="localhost";
    $dbuser="root";
    $dbpw="";
    $dbname="db_ebda3";
    $connection = mysqli_connect($dbhost,$dbuser,$dbpw,$dbname);

//test if connection occured
    if(mysqli_connect_errno())
    {
        die("Database connection failed:". mysqli_connect_error() ."(". mysqli_connect_errno() . ")");
    }

if (isset($_POST["ResetPasswordForm"]))
{
    // Gather the post data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $hash = $_POST["q"];
    // Use the same salt from the forgot_password.php file
    $salt = "498#2D83B631%3800EBD!801600D*7E3CC13";
    // Generate the reset key
    $resetkey = hash('sha512', $salt.$email);
    // Does the new reset key match the old one?
    if ($resetkey == $hash)
    {
        if ($password == $confirmpassword)
        {
        
                $password =md5( $password);
                // Update the user's password
                $query = $conn->prepare('UPDATE users SET password = :password WHERE email = :email');
                $query->bindParam(':password', $password);
                $query->bindParam(':email', $email);
                $query->execute();
                echo "Your password has been successfully reset.";
        }
        else
            echo "Your password's do not match.";
    }
    else
        echo "Your password reset key is invalid.";

}
?>
