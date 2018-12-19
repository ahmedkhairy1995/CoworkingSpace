<? php

      echo "here";
$mailbody = "Dear user,\n\nIf this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website www.yoursitehere.com\n\nTo reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n"  . "\n\nThanks,\nThe Administration";
      
        $headers = "From: ahmedkhaledkhairy@gmail.com \r\n" .
                    "Content-type: text/html; charset=iso-8859-1\r\n" .
                    'X-Mailer: PHP/' . phpversion();
if(mail("may.ahmed1@hotmail.com", "ebda3- Password Reset", $mailbody,$headers))       
echo "Your password recovery key has been sent to your e-mail address.";
else
    echo"error in sending email";
            
?>