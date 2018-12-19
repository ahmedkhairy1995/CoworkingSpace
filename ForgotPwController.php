<?php
 function redirect_to ($newlocation)
 {
	header("Location:".$newlocation);
	exit;
 }
?>

<?php

    ini_set('display_errors', 1); 
    error_reporting(E_ALL);

    include('Db.php');

if (isset($_POST["ForgotPassword"])) {
    
    if (filter_var($_POST["Email_ForgotPassword"], FILTER_VALIDATE_EMAIL)) {
    
        $email = $_POST["Email_ForgotPassword"];
   
    }
    
     $db= new Db();
     $query = $db->select("Select * FROM users where email='{$email}'");
    
    if($query != NULL)
    {
      
        
        // Create the unique user password reset key
        $dbpassword= $query[0]['password'];
        
        // Create a url which we will direct them to reset their password
        $pwrurl = "http://localhost/FrontEnd/ResetPassword.php?q=".$dbpassword;
        
        // Mail them their key
        $mailbody = "Dear user,\n\nIf this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website www.yoursitehere.com\n\nTo reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n" . $pwrurl . "\n\nThanks,\nThe Administration";
        
        $mailbody= wordwrap($mailbody, 70, "\r\n");
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From: ahmedkhaledkhairy@gmail.com"."\r\n";
        $headers .= "Reply-To: ahmedkhaledkhairy@gmail.com". "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        $headers .= "X-Priority: 1" . "\r\n"; 
        if(mail($email, "ebda3- Password Reset", $mailbody,$headers, " -fahmedkhaledkhairy@gmail.com"))

        redirect_to("Homepage.php?flag=3");
        else
            redirect_to("Homepage.php?flag=4");
        
    }
    else
        
        redirect_to("Homepage.php?flag=5");
}
?>
