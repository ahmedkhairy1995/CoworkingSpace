<?php
session_start();
if (isset($_GET['flag']))
    $flag = $_GET['flag'];
?>


<?php
require_once('ContactInfoTableController.php');
require_once('RoomTableController.php');
require_once('ReservationTableController.php');


if (!isset($_SESSION['views'])) {
    redirect_to("LoginPage.php");
}
if (isset($_GET['id']))
    $ID = $_GET['id'];

$contactInfoController = ContactInfoTableController::getContactInfoTableController();
$roomsController = RoomTableController::getRoomTableController();
$reservationController = ReservationTableController::getReservationTableController();
$contacts = $contactInfoController->getAllContacts();

?>
<?php function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

?>


<?php
$reservation = $reservationController->getReservationById($ID);

if ($reservation != null) {
    $UserId = $reservation->getUserId();
    $RoomNumber = $reservation->getRoomNo();
    $From = $reservation->getStartTime();
    $To = $reservation->getEndTime();
    $Projector = $reservation->getProjector();
    $Markers = $reservation->getMarkers();
    $WhiteBoard = $reservation->getWhiteBoard();
    $AC = $reservation->getAC();
    $Date = $reservation->getDate();
    $Capacity = $reservation->getCapacity();
} else
    redirect_to('Homepage.php');
?>


<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Book a room"/>
    <title>Book a room</title>

    <!--Applying an external stylesheet-->
    <link rel="stylesheet" href="bootstrap.css">
    <script src="sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
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
    <nav id="MainMenuNavigation" class="nav nav-tabs-justified">
        <div class="cl-effect-14">
            <a href="Homepage.php" title="Homepage" class="Home btn" role="button">Homepage</a>
            <a href="Reservation.php" title="" class="btn" role="button">Book A Room</a>
            <a href="ViewReservation.php" title="" class="btn" role="button">My Reservations</a>
            <a href="AboutUs.php" title="" class="btn " role="button">About Us</a>
        </div>
        <?php
        if (!isset($_SESSION['views'])) {
            ?>
            <div class="cl-effect-14">
                <a href="LoginPage.php" title="" class="btn" role="button">Login</a>
            </div>
            <?php
        } else {
            ?>

            <div class="dropdown">
                <a href="" title="" class="btn" role="button" data-toggle="dropdown" id="menu" aria-haspopup="true"
                   aria-expanded="true"><?php echo $_SESSION['name'] ?>
                    <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="menu">
                    <li><a href="EditProfile.php" title="">Edit Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="LogOut.php" title="" id="logout">Logout</a></li>
                </ul>
            </div>

            <?php
        }
        ?>


    </nav>

    <div id="BookARoomSpan">
        <span>Edit Reservation</span>
    </div>

    <div id="_BookARoom">
        <!--Creating A Form-->
        <!--The action attribute defines the action to be performed when the form is submitted.
        Normally, the form data is sent to a web page on the server when the user clicks on the submit button.
        In the example above, the form data is sent to a page on the server called "/action_page.php". This page contains a server-side script that handles the form data-->
        <form id="BookARoom" name="LoginForm" action="<?php echo "EditResController.php?id=" . $ID; ?>" method="post">
            <p><strong>Room</strong></p>

            <select name="roomForm">

                <?php
                $list = $roomsController->getAllFreeRooms();
                $i = 0;
                while ($i < count($list)) {
                    ?>
                    <option value="<?php echo $list[$i]->getRoomID(); ?>"<?php if ($list[$i]->getRoomID() == $RoomNumber) {
                        echo "selected";
                    } ?>>
                        <?php echo $list[$i]->getRoomID(); ?>


                    </option>
                    <?php $i++;
                } ?>


            </select><br><br>

            <p><strong>Date</strong><i style="color:dimgrey;">&nbsp &nbsp (yyyy-mm-dd)</i></p>
            <input id="DatePicker" type="date" name="reservationDay" value="<?php echo "$Date" ?>"><br><br>

            <p><strong>Capacity</strong></p>

            <input type="number" name="Capacity" min="1" max="6" required value="<?php echo "$Capacity" ?>"><br><br>

            <p><strong>From</strong><i style="color:dimgrey;">&nbsp Price per hour: 5 EGP</i></p>
            <input type="time" name="from" step="1800" min="12:00" max="22:00" value="<?php echo "$From" ?>">

            <p><strong>To</strong></p>
            <input type="time" name="to" step="1800" min="12:30" max="23:00" value="<?php echo "$To" ?>"><br><br>

            <p><strong>Additionals</strong></p>

            <input type="checkbox" id="checkbox1" name="Projector"
                   value="Projector"<?php if ($Projector == 'Yes') echo 'checked'; ?>>Projector
            &nbsp; &nbsp;
            <input type="checkbox" id="checkbox2" name="Markers"
                   value="Markers"<?php if ($Markers == 'Yes') echo 'checked'; ?>>Markers
            &nbsp; &nbsp;
            <input type="checkbox" id="checkbox3" name="WhiteBoard"
                   value="WhiteBoard"<?php if ($WhiteBoard == 'Yes') echo 'checked'; ?>>WhiteBoard
            &nbsp; &nbsp;
            <input type="checkbox" id="checkbox4" name="AC"
                   value="AC"<?php if ($AC == 'Yes') echo 'checked'; ?>>AC<br><br>

            <!--<input type="submit"> defines a button for submitting form data to a form-handler.
The form-handler is typically a server page with a script for processing input data.-->
            <input type="submit" name="UpdateReservation" value="Update Reservation">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script><!--applying jQuery library-->

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