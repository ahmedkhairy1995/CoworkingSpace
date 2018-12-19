<?php
session_start();
if (isset($_GET['flag']))
    $flag = $_GET['flag'];
?>

<?php
require_once('ContactInfoTableController.php');
require_once('RoomTableController.php');

$contactInfoController = ContactInfoTableController::getContactInfoTableController();
$roomsController = RoomTableController::getRoomTableController();
$contacts = $contactInfoController->getAllContacts();

?>
<?php function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

?>
<?php if (!isset($_SESSION['views'])) {
    redirect_to("LoginPage.php");
}
?>

<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <!-- IE Edge Meta Tag -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Viewport -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Book a room"/>
    <title>Book a room</title>
    <!--Applying an external stylesheet-->
    <link rel="stylesheet" href="font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" href="component.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
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
            <div class="dropdown">
                <a href="" title="" class="btn" role="button" data-toggle="dropdown" id="menu" aria-haspopup="true"
                   aria-expanded="true">
                    <?php echo $_SESSION['name'] ?>
                    <span class="caret"/>
                </a>
                <ul class="dropdown-menu" aria-labelledby="menu">
                    <li><a href="EditProfile.php" title="">Edit Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="LogOut.php" title="" id="logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div id="BookARoomSpan">
    <span>Book a room</span>
</div>

<div id="_BookARoom">
    <!--Creating A Form-->
    <!--The action attribute defines the action to be performed when the form is submitted.
    Normally, the form data is sent to a web page on the server when the user clicks on the submit button.
    In the example above, the form data is sent to a page on the server called "/action_page.php". This page contains a server-side script that handles the form data-->
    <form id="BookARoom" name="LoginForm" action="ReservationController.php" method="post">
        <p><strong>Room</strong></p>
        <select name="roomForm" Room Num='NEW'>
            <option value=""><?php if (isset($_SESSION['RoomNumber'])) echo $_SESSION['RoomNumber']; else echo "--Select--"; ?></option>

            <?php
            $list = $roomsController->getAllFreeRooms();
            $i = 0;
            $select = "db_ebda3";
            if (isset ($select) && $select != "") {
                $select = $_POST ['NEW'];
            }
            while ($i < count($list)) {
                ?>
                <option
                        value="<?php echo $list[$i]->getRoomID(); ?>"<?php if ($list[$i]->getRoomID() === $select) {
                    echo "selected";
                } ?>>
                    <?php echo $list[$i]->getRoomID(); ?>
                </option>
                <?php $i++;
            } ?>

        </select><br><br>

        <p><strong>Date</strong><i style="color:dimgrey;">&nbsp &nbsp (yyyy-mm-dd)</i></p>
        <input id="DatePicker" type="date" name="reservationDay"
               value="<?php if (isset($_SESSION['Date'])) echo $_SESSION['Date']; ?>"><br><br>

        <p><strong>Capacity</strong></p>
        <input type="number" name="Capacity"
               value="<?php if (isset($_SESSION['Capacity'])) echo $_SESSION['Capacity']; ?>" min="1" max="10" required><br><br>

        <p><strong>From</strong><i style="color:dimgrey;">&nbsp Price per hour: 5 EGP</i></p>
        <input type="time" name="from" value="<?php if (isset($_SESSION['From'])) echo $_SESSION['From']; ?>"
               step="1800" min="12:00" max="22:00">

        <p><strong>To</strong></p>
        <input type="time" name="to" value="<?php if (isset($_SESSION['To'])) echo $_SESSION['To']; ?>" step="1800"
               min="12:30" max="23:00"><br><br>

        <p><strong>Additionals</strong></p>
        <input type="checkbox" id="checkbox1" name="Projector" value="Projector" <?php if (isset($_SESSION['To'])) {
            if ($_SESSION['Projector'] == "Yes") echo "checked";
        } ?> >Projector
        &nbsp; &nbsp;
        <input type="checkbox" id="checkbox2" name="Markers" value="Markers" <?php if (isset($_SESSION['Marker'])) {
            if ($_SESSION['Marker'] == "Yes") echo "checked";
        } ?>>Markers
        &nbsp; &nbsp;
        <input type="checkbox" id="checkbox3" name="WhiteBoard"
               value="WhiteBoard"<?php if (isset($_SESSION['WhiteBoard'])) {
            if ($_SESSION['WhiteBoard'] == "Yes") echo "checked";
        } ?>>WhiteBoard
        &nbsp; &nbsp;
        <input type="checkbox" id="checkbox4" name="AC" value="AC" <?php if (isset($_SESSION['AC'])) {
            if ($_SESSION['AC'] == "Yes") echo "checked";
        } ?>>AC<br><br>

        <!--<input type="submit"> defines a button for submitting form data to a form-handler.
The form-handler is typically a server page with a script for processing input data.-->
        <input type="submit" name="checkAvailability" value="Check Availability">
        <br><br>

    </form>
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
            <p>+20 <?php echo $contacts[0]->getContactNum(); ?> </p><br>
            <i class="fa fa-phone"></i>
            <p>+20 <?php echo $contacts[1]->getContactNum(); ?></p>
        </div>
    </div>
    <?php
    if (isset($_SESSION['RoomNumber'])) {
        unset($_SESSION['RoomNumber']);
        unset($_SESSION['Date']);
        unset($_SESSION['From']);
        unset($_SESSION['To']);
        unset($_SESSION['Projector']);
        unset($_SESSION['Marker']);
        unset($_SESSION['AC']);
        unset($_SESSION['WhiteBoard']);
        unset($_SESSION['Capacity']);
    }
    ?>

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
<script>
    javaScriptVar = "<?php echo $flag; ?>";

    if (javaScriptVar === "1") {
        swal("Blocked User", "Please contact the admin ", "error");
    }
    else if (javaScriptVar === "2") {
        swal("Invalid Date", "Please enter valid date ", "error");
    }
    else if (javaScriptVar === "3") {
        swal("Invalid Time", "Please enter valid time", "error");
    }
    else if (javaScriptVar === "4") {
        swal("Sorry!", "The room is reserved and the capacity is less than what you need  ", "error");
    }
    else if (javaScriptVar === "5") {
        swal("Sorry!", "The room is reserved ", "error");
    }
    else if (javaScriptVar === "6") {
        swal("Sorry!", "The capacity is less than what you need.", "error");
    }
</script>
</body>
</html>