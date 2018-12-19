<?php
session_start();
if (isset($_GET['flag']))
    $flag = $_GET['flag'];

include('ContactInfoTableController.php');
$contactInfoController = ContactInfoTableController::getContactInfoTableController();
$contacts = $contactInfoController->getAllContacts();
?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Create your Ebdaa Account"/>
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
                <a href="ViewReservation.php" title="" role="button">My Reservations</a>
                <a href="AboutUs.php" title="" role="button">About Us</a>
                <a href="LoginPage.php" title="" role="button">Login</a>
            </div>

        </nav>
    </div>

    <div id="SignUpSpan">
        <span>Create your Ebda3 Account</span>
    </div>

    <aside class="signUpAside">
        <h3>One account is all you need &nbsp;<i class="fa fa-thumbs-up"></i></h3>
    </aside>

    <div id="SignUpForm">
        <!--Creating A Form-->
        <!--The action attribute defines the action to be performed when the form is submitted.
        Normally, the form data is sent to a web page on the server when the user clicks on the submit button.
        In the example above, the form data is sent to a page on the server called "/action_page.php". This page contains a server-side script that handles the form data-->
        <form id="_SignUpForm" name="SignUpForm" action="SignupController.php" method="post">

            <p><strong>Name</strong></p>
            <!--type attribute can have values such as text,radio,submit,checkbox-->
            <input type="text" name="FirstName" placeholder="First" id="firstName"
                   value="<?php if (isset($_SESSION['FirstName'])) echo $_SESSION['FirstName']; ?>" required>
            <input type="text" name="LastName" placeholder="Last" id="lastName"
                   value="<?php if (isset($_SESSION['LastName'])) echo $_SESSION['LastName']; ?>" required><br>

            <p><strong>Email</strong>
            <p>
                <input type="email" name="Email"
                       value="<?php if (isset($_SESSION['Email'])) echo $_SESSION['Email']; ?>" required>
            <p><strong>Confirm email</strong></p>
            <input type="email" name="EmailConfirmation" required>

            <p><strong>Create a password</strong></p>
            <input type="password" name="Password" minlength="6" value="" required>
            <p><strong>Confirm your password</strong></p>
            <input type="password" name="PasswordConfirmation" minlength="6" value="" required><br>

            <p><strong>Birthday</strong><i style="color:dimgrey;">&nbsp &nbsp (yyyy-mm-dd)</i></p>
            <input type="date" name="bday" min="1970-01-02"
                   value="<?php if (isset($_SESSION['bday'])) echo $_SESSION['bday']; ?>"><br><br>

            <div class="form-group">

                <!--<p><strong>Gender</strong></p>-->
                <label class="radio-inline">
                    <input type="radio" class="Radio" name="gender" value="M" <?php if (isset($_SESSION['gender'])) {
                        if ($_SESSION['gender'] == 'M') echo "checked";
                    } ?> required><!--We can add checked attribute if we want it to be checked as a default-->
                    Male
                </label>

                <label class="radio-inline">
                    <input type="radio" class="Radio" name="gender" value="F" <?php if (isset($_SESSION['gender'])) {
                        if ($_SESSION['gender'] == 'F') echo "checked";
                    } ?> required>
                    Female
                </label>
            </div>

            <p><strong>Mobile Phone</strong></p>
            <input type="tel" name="MobileNumber" placeholder="+20"
                   value="<?php if (isset($_SESSION['MobileNumber'])) echo $_SESSION['MobileNumber']; ?>" required><br>

            <p><strong>Current address</strong></p>
            <input type="text" name="Address"
                   value="<?php if (isset($_SESSION['Address'])) echo $_SESSION['Address']; ?>" required><br>

            <p><strong>ID number</strong></p>
            <input type="text" ID="IDNumber" name="IDNumber2"
                   value="<?php if (isset($_SESSION['IDNumber2'])) echo $_SESSION['IDNumber2']; ?>" minlength="14"
                   maxlength="14" required>

            <br><br>
            <!--<input type="submit"> defines a button for submitting form data to a form-handler.
            The form-handler is typically a server page with a script for processing input data.-->
            <input type="submit" name="submit" value="Submit" class="btn btn-success pull-left">
        </form>
    </div>

</div>
<?php session_destroy(); ?>
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
            <p>+20 <?php echo $contacts[0]->getContactNum(); ?> </p><br>
            <i class="fa fa-phone"></i>
            <p>+20 <?php echo $contacts[1]->getContactNum(); ?></p>
        </div>
    </div>


    <div class="footer-right">
        <p class="footer-company-about">
            <span>About us</span>
            We're an organization that works on developing the ability and skills needed to perform the optimum way,
            releasing one's maximum creativity.
        </p>

        <div class="footer-icons">
            <a href="https://www.facebook.com/Ebda3.Spaces/" target="_blank"><i class="fa fa-facebook"></i></a>
        </div>
    </div>
</footer>

<!--Applying an external javascript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="myScript.js"></script>
<script src="SignUpScript.js"></script>

<script>

    javaScriptVar = "<?php echo $flag; ?>";
    if (javaScriptVar === "1") {
        swal("Error", "This is a wrong ID!", "error");
    }
    else if (javaScriptVar === "2") {
        swal("Error", "Confirm your email", "error");
    }
    else if (javaScriptVar === "3") {
        swal("Error", "Check your password", "error");
    }
    else if (javaScriptVar === "4") {
        swal("Error", "You are already signed up", "error");
    }
    else if (javaScriptVar === "5") {
        swal("Error", "<?php echo $_SESSION['DB-Error']?>", "error");
    }
</script>
</body>
</html>