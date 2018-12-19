<?php 
    session_start();
    if(isset($_GET['flag']))
    $flag=$_GET['flag'];
    include('Db.php');
    $db=new Db();
     $contactInfoArray=$db->selectContactInfo();
?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Create your Ebdaa Account" />
    <title>Sign Up</title>

    <!--Applying an external stylesheet-->
    <script src="sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="component.css">
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <link rel="stylesheet" href="font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>


    <div id="body">
    <!--logo of the co-working space-->
    <img id="Logo" src="logo.jpg" alt="Logo">

        <!--Main Menu Navigation Tabs-->
        <div id="MenuTab">
        <nav id="MainMenuNavigation" class="nav nav-tabs-justified">
            <div class="cl-effect-14">
                <a href="Homepage.php" title="Homepage" role="button">Homepage</a>
                <a href="Reservation.php" title="" role="button">Book A Room</a>
                <a href="ViewReservation.php" title=""  role="button">My Reservations</a>
                <a href="AboutUs.php" title=""  role="button">About Us</a>
                <a href="LoginPage.php" title="" role="button">Login</a>
            </div>
            
        </nav>


        <div id="ResetPassword">
            <span>Reset your password</span>
        </div>

        <div id="ForgotPasswordForm">
            <!--Creating A Form-->
            <!--The action attribute defines the action to be performed when the form is submitted.
            Normally, the form data is sent to a web page on the server when the user clicks on the submit button.
            In the example above, the form data is sent to a page on the server called "/action_page.php". This page contains a server-side script that handles the form data-->
            <form id="_ForgotPasswordForm" name="ForgotPw" action="ForgotPwController.php" method="post">

                <div id="user_icon">
                <i class="fa fa-user"></i>
                </div><br>

                <input type="email" name="Email_ForgotPassword" value="Email" id="emailLogin" autocomplete="off" required>

                <br><br>
                <!--<input type="submit"> defines a button for submitting form data to a form-handler.
                The form-handler is typically a server page with a script for processing input data.-->
                <input type="submit" name="ForgotPassword" value="Reset Password">
                <br><br>

            </form>
        </div>

    </div>

   <footer class="footer-distributed">
        
        <div class="footer-left">
            <h3><span>Ebda3</span></h3>
            <p class="footer-company-name">Ebdaa &copy; 2017</p>
            <br><br>
            <p class="footer-company-rights">All rights reserved &trade;</p>
        </div>


        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>28 Gaber Ibn Haian Street</span> Ad Dokki, Al Jizah, Egypt</p>
            </div>
            <div>
				<i class="fa fa-phone"></i>
				<p>+20 <?php echo $contactInfoArray[0]['contactNum']; ?> </p><br>
				<i class="fa fa-phone"></i>
				<p>+20 <?php echo $contactInfoArray[1]['contactNum']; ?></p>
            </div>
        </div>


        <div class="footer-right">
            <p class="footer-company-about">
                <span>About us</span>
            We're an organization that works on developing the ability and skills needed to perform the optimum way, releasing one's maximum creativity.
            </p>

            <div class="footer-icons">
                <a href="https://www.facebook.com/Ebda3.Spaces/" target="_blank"><i class="fa fa-facebook"></i></a>
            </div>
        </div>
    </footer>




    <!--Applying an external javascript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script><!--applying jQuery library-->
    <script src="LoginScript.js"></script>
</body>
</html>