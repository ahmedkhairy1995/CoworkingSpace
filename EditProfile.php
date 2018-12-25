<?php
session_start();
$flag = -1;
if (isset($_GET['flag']))
    $flag = $_GET['flag'];
?>

<?php
require_once('ReservationTableController.php');
require_once('RoomTableController.php');
require_once('UsersTableController.php');
require_once('User.php');
require_once('ContactInfoTableController.php');
$userController = UsersTableController::getUsersTableController();
$contactInfoController = ContactInfoTableController::getContactInfoTableController();
$contacts = $contactInfoController->getAllContacts();
?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Edit your profile</title>
    <link rel="icon" type="image/png" href="logo.jpg"/>

    <!--Applying an external stylesheet-->
    <script src="sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/buttons.css">
    <link rel="stylesheet" href="css/component.css">
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">

</head>

<body>

<div id="body">


    <!--logo of the co-working space-->
    <div id="LogoDiv">
        <img id="Logo" src="logo.jpg" alt="Logo">
    </div>

    <!--Main Menu Navigation Tabs-->
    <div id="MenuTab">
        <nav id="MainMenuNavigation" class="nav nav-tabs-justified">
            <div class="cl-effect-14">
                <a href="Homepage.php" title="Homepage" role="button">Homepage</a>
                <a href="Reservation.php" title="" role="button">Book A Room</a>
                <a href="ViewReservation.php" title="" role="button">My Reservations</a>
                <a href="AboutUs.php" title="" role="button">About Us</a>
                <?php
                if (!isset($_SESSION['views']))
                {
                    ?>
                    <a href="LoginPage.php" title="" role="button">Login</a>
                    <?php
                }
                else
                {
                ?>
                <div class="dropdown">
                    <a href="" class="btn" title="" role="button" data-toggle="dropdown" id="menu" aria-haspopup="true"
                       aria-expanded="true">
                        <?php echo $_SESSION['name'] ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="menu">
                        <li><a href="EditProfile.html" title="">Edit Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="LogOut.php" title="" id="logout">Logout</a></li>
                    </ul>
                </div>
            </div>
            <?php
            }
            ?>
        </nav>
    </div>

    <div id="EditYourProfileSpan">
        <span>Edit your Ebdaa account</span>
    </div>

    <div id="EditProfileForm">
        <!--Creating A Form-->
        <!--The action attribute defines the action to be performed when the form is submitted.
        Normally, the form data is sent to a web page on the server when the user clicks on the submit button.
        In the example above, the form data is sent to a page on the server called "/action_page.php". This page contains a server-side script that handles the form data-->
        <form id="_EditProfileForm" name="EditProfileForm" action="EditProfController.php" method="post">


            <?php
            $email = $_SESSION['views'];
            $user = $userController->getUserByEmail($email);

            $FirstName = $user->getFirstName();
            $LastName = $user->getLastName();
            $Email = $user->getEmail();
            $bday = $user->getBirthday();
            $MobileNumber = $user->getMobileNumber();
            $Address = $user->getAddress();

            ?>

            <p><strong>Name</strong></p>
            <!--type attribute can have values such as text,radio,submit,checkbox-->
            <input type="text" name="FirstName" placeholder="First" id="firstName" value="<?php echo "$FirstName" ?>"
                   required>
            <input type="text" name="LastName" placeholder="Last" id="lastName" value="<?php echo "$LastName" ?>"
                   required><br>

            <p><strong>Email</strong>
            <p>
                <input type="email" name="Email" value="<?php echo $Email; ?>" required>
            <p><strong>Confirm email</strong></p>
            <input type="email" name="EmailConfirmation" value="<?php echo $Email; ?>" required>

            <p><strong>Current password</strong></p>
            <input type="password" name="Password" minlength="6" value="" required>

            <p><strong>New password</strong></p>
            <input type="password" name="NewPassword" minlength="6" value=""><br>

            <p><strong>Confirm new password</strong></p>
            <input type="password" name="ConfirmNewPassword" minlength="6" value=""><br>

            <p><strong>Mobile Phone</strong></p>
            <input type="tel" name="MobileNumber" placeholder="+20" value="<?php echo $MobileNumber; ?>"><br>

            <p><strong>Current address</strong></p>
            <input type="text" name="Address" value="<?php echo $Address; ?>" required><br>

            <br><br>
            <!--<input type="submit"> defines a button for submitting form data to a form-handler.
            The form-handler is typically a server page with a script for processing input data.-->
            <input type="submit" name="SaveProfile" value="Save" class="btn btn-primary">
        </form>
    </div>
</div>

<?php include("Footer.php")?>

<!--Applying an external javascript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"/>
<script src="js/SignUpScript.js"/>

<script>

    javaScriptVar = "<?php echo $flag; ?>";
    if (javaScriptVar === "1")
        swal("Confirm Password", "Password doesn't match", "error");
    else if (javaScriptVar === "2")
        swal("Wrong Password", "Please enter your old password", "error");
    else if (javaScriptVar === "3")
        swal("Wrong Email format ", "Please reenter your email", "error");
    else if (javaScriptVar === "4")
        swal("Wrong Name format ", "Please reenter your name", "error");
    else if (javaScriptVar === "5")
        swal("Wrong Mobile format ", "Please reenter your mobile number", "error");
    else if (javaScriptVar === "6")
        swal("Wrong Password format ", "Your Password Must Contain At Least 8 Characters! Contain At Least 1 Number, 1 Capital Letter,and 1 Lowercase Letter!", "error");
    else if (javaScriptVar === "7")
        swal("Wrong Address format ", "Please reenter your address", "error");

</script>
</body>
</html>