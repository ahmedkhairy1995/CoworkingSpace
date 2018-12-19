<?php
session_start();
if (isset($_GET['flag']))
    $flag = $_GET['flag'];
?>

<?php
//session_start();
require_once('ContactInfoTableController.php');
require_once('ReservationTableController.php');
require_once('UsersTableController.php');

$contactInfoController = ContactInfoTableController::getContactInfoTableController();
$reservationController = ReservationTableController::getReservationTableController();
$userTableController = UsersTableController::getUsersTableController();
$contacts = $contactInfoController->getAllContacts();
?>
<?php
function redirect_to($newlocation)
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
    <meta name="description" content="Ebda3 Co-Working space.One of the leading coworking spaces in Egypt"/>
    <title>View Reservations</title>
    <script src="sweetalert/dist/sweetalert.min.js"></script>
    <!-- Minified CSS -->
    <link rel="stylesheet" href="font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap.css">

    <!--Applying an external stylesheet-->
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" href="component.css">
    <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="buttons.css">
    <style>
        .dropdown {
            position: absolute;
            right: 27%;
            top: 5px;
        }

    </style>
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
                    <span class="caret"></span>
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

<form>
    <?php
    echo "<div class='container'>";
    echo '<div class="table-responsive">';
    echo '<table class="table" style="border: solid 1px white;">';
    echo '<thead class="tableHeader"><tr><th>Reservation ID</th><th>Room</th><th>Start Time</th><th>End Time</th><th >Pojector?</th><th>Markers?</th><th>WhiteBoard?</th><th>AC?</th><th>Date</th><th>Edit?</th><th>Cancel?</th></tr></thead>';

    try {
        if (isset($_SESSION['views'])) {
            $email = $_SESSION['views'];
            $userID = $userTableController->getUserByEmail($email)->getId();
            $todayDate = date("Y-m-d");

            $reservations = $reservationController->getReservationsOfUser($userID, $todayDate);
            foreach ($reservations as $reservation) {
                echo "<tr>";
                echo '<td class="hooverable" style="width:150px;border:1px solid white;">' . $reservation->getReservationId() . "</td>";
                echo '<td class="hooverable" style="width:150px;border:1px solid white;">' . $reservation->getRoomNo() . "</td>";
                echo '<td class="hooverable" style="width:150px;border:1px solid white;">' . $reservation->getStartTime() . "</td>";
                echo '<td class="hooverable" style="width:150px;border:1px solid white;">' . $reservation->getEndTime() . "</td>";
                echo '<td class="hooverable" style="width:150px;border:1px solid white;">' . $reservation->getProjector() . "</td>";
                echo '<td class="hooverable" style="width:150px;border:1px solid white;">' . $reservation->getMarkers() . "</td>";
                echo '<td class="hooverable" style="width:150px;border:1px solid white;">' . $reservation->getWhiteBoard() . "</td>";
                echo '<td class="hooverable" style="width:150px;border:1px solid white;">' . $reservation->getAC() . "</td>";
                echo '<td class="hooverable" style="width:150px;border:1px solid white;">' . $reservation->getDate() . "</td>";
                echo '<td><a href="EditReservation.php?id=' . ($reservation->getReservationId()) . '"><button name="edit"  id="' . ($reservation->getReservationId()) . '" class="btn2 btn-4 btn-4c" type="button">edit</button></a></td>';
                echo '<td><a ><i onclick="myFunction(' . ($reservation->getReservationId()) . ')" id="' . ($reservation->getReservationId()) . '" class="fa fa-trash-o hoverBin" aria-hidden="true"></i></a></td></tr>' . "\n";
            }

        } else {
            redirect_to("LoginPage.php");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    echo "</table>";
    echo "</div>";
    echo "</div>";
    ?>

</form>

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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>src = "jquery-3.2.0.js"</script>

<script>

    var javaScriptVar = "<?php echo $flag; ?>";
    if (javaScriptVar === "1") {
        swal("Confirmed!", "Your Reservation is confirmed", "success");
    }
</script>

<script>
    function myFunction(x) {
        swal({
                title: "Cancel Reservation",
                text: "Are you sure you want to cancel this reservation?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function () {
                window.location.replace("DeleteReservationController.php?id=" + x);
            });

    }
</script>
</body>
</html>                        