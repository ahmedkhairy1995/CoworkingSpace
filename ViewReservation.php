<?php
session_start();
$flag = -1;
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
    <link rel="icon" type="image/png" href="logo.jpg"/>
    <title>View Reservations</title>
    <script src="sweetalert/dist/sweetalert.min.js"></script>
    <!-- Minified CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <!--Applying an external stylesheet-->
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link rel="stylesheet" href="css/component.css">
    <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="css/buttons.css">
    <style>
        .dropdown {
            position: absolute;
            right: 27%;
            top: 5px;
        }

    </style>
</head>

<body>

<?php include("Header.php")?>
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
<?php include("Footer.php")?>


<!--Applying an external javascript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script><!--applying jQuery library-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>src = "js/jquery-3.2.0.js"</script>

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