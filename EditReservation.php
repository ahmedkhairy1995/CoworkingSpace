<?php
session_start();
$flag = -1;
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
    <link rel="icon" type="image/png" href="logo.jpg"/>
    <!--Applying an external stylesheet-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="css/component.css">
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>


<div id="body">

    <?php include("Header.php")?>

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

            <input type="number" name="Capacity" min="1" max="50" required value="<?php echo "$Capacity" ?>"><br><br>

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
<?php include("Footer.php")?>

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
    else if (javaScriptVar === "7") {
        swal("Sorry!", "The capacity or the room is not a number", "error");
    }

</script>
</body>
</html>