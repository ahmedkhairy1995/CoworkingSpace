<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 12/19/2018
 * Time: 7:14 PM
 */
function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

session_start();
if (!isset($_SESSION['admin'])) {
    redirect_to("Login.php");
}
?>

<?php
require_once('../ReservationTableController.php');
require_once('../RoomTableController.php');
?>
<?php
$reservationController = ReservationTableController::getReservationTableController();
$roomController = RoomTableController::getRoomTableController();

$ID = isset($_POST['reservationID']) ? $_POST['reservationID'] : "";
$UserId = isset($_POST['userID']) ? $_POST['userID'] : "";
$RoomNumber = isset($_POST["roomForm"]) ? $_POST["roomForm"] : "";
$Date = isset($_POST["reservationDay"]) ? $_POST["reservationDay"] : "";
$From = isset($_POST["from"]) ? $_POST["from"] : "";
$To = isset($_POST["to"]) ? $_POST["to"] : "";
$Projector = isset($_POST["Projector"]) ? 'Yes' : 'No';
$Marker = isset($_POST["Markers"]) ? 'Yes' : 'No';
$AC = isset($_POST["AC"]) ? 'Yes' : 'No';
$WhiteBoard = isset($_POST["WhiteBoard"]) ? 'Yes' : 'No';
$Capacity = isset($_POST["Capacity"]) ? $_POST["Capacity"] : "";


//to get the capacity of the room
$maxCapacity = $roomController->getCapacityOfRoom($RoomNumber);

//to check if the room is reserved
$count = $reservationController->checkRoomAvailabilityForOtherReservations($ID, $RoomNumber, $From, $To, $Date);

$UserId = $reservationController->getReservationById($ID)->getUserId();
if ($Date < date("Y-m-d")) {
    redirect_to("EditReservation.php?flag=2&id=" . $ID);
} elseif ($To < $From) {
    redirect_to("EditReservation.php?flag=3&id=" . $ID);
} else if ($count != 0 && $maxCapacity < $Capacity) {
    redirect_to("EditReservation.php?flag=4&id=" . $ID);
} else if ($count != 0) {
    //redirect to "Sorry! This room is already reserved by another user."
    redirect_to("EditReservation.php?flag=5&id=" . $ID);
} else if ($maxCapacity < $Capacity) {
    redirect_to("EditReservation.php?flag=6&id=" . $ID);
} else if (!is_numeric($Capacity) || !is_numeric($RoomNumber)) {
    redirect_to("EditReservation.php?flag=7&id=" . $ID);
} else {
    $result = $reservationController->updateReservation($ID, $UserId, $RoomNumber, $From, $To, $Projector, $Marker, $WhiteBoard, $AC, $Date, $Capacity);
    echo "May";
    if ($result)
        redirect_to("Reservations.php?flag=1");
    else
        echo mysqli_connect_errno();
}


?>
