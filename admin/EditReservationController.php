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

if (!isset($_SESSION['admin'])) {
    redirect_to("Login.php");
}
?>

<?php
session_start();
require_once('../ReservationTableController.php');
require_once('../RoomTableController.php');
?>
<?php
$reservationController = ReservationTableController::getReservationTableController();
$roomController = RoomTableController::getReservationTableController();

if (isset($_SESSION['views'])) {

    if (isset($_POST["UpdateReservation"])) {
        $ID = $_GET['id'];
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
        $count = $reservationController->checkRoomAvailability($RoomNumber, $From, $To, $Date);

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
        } else {
            $result = $db->query("UPDATE reservation SET user_id=$userID,room_no=$RoomNumber,startTime='$From',endTime='$To',projector='$Projector',markers='$Marker',whiteBoard='$WhiteBoard',AC='$AC',date='$Date', capacity=$Capacity WHERE reservation_id = $ID");

            if ($result)
                redirect_to("ViewReservation.php?flag=1");
            else
                echo mysqli_connect_errno();
        }
    }

} else {
    redirect_to("Login.php");
}


?>
