<?php
function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

?>
<?php
session_start();
require_once('ReservationTableController.php');
require_once('RoomTableController.php');
require_once('UsersTableController.php');
require_once('ValidationController.php');
require_once('User.php');
?>
<?php
$roomController = RoomTableController::getRoomTableController();
$userController = UsersTableController::getUsersTableController();
$reservationController = ReservationTableController::getReservationTableController();
$validationController = ValidationController::getValidationController();

if (isset($_SESSION['views'])) {
    if (isset($_POST["checkAvailability"])) {
        $RoomNumber = isset($_POST["roomForm"]) ? $_POST["roomForm"] : "";
        $Date = isset($_POST["reservationDay"]) ? $_POST["reservationDay"] : "";
        $From = isset($_POST["from"]) ? $_POST["from"] : "";
        $To = isset($_POST["to"]) ? $_POST["to"] : "";
        $Projector = isset($_POST["Projector"]) ? 'Yes' : 'No';
        $Marker = isset($_POST["Markers"]) ? 'Yes' : 'No';
        $AC = isset($_POST["AC"]) ? 'Yes' : 'No';
        $WhiteBoard = isset($_POST["WhiteBoard"]) ? 'Yes' : 'No';
        $Capacity = isset($_POST["Capacity"]) ? $_POST["Capacity"] : "";

        $email = $_SESSION['views'];
        $user = $userController->getUserByEmail($email);
        $userID = $user->getId();
        $blocked = $user->getBlocked();

        //to get the capacity of the room
        $maxCapacity = $roomController->getCapacityOfRoom($RoomNumber);

        //to check if the room is reserved
        $count = $reservationController->checkRoomAvailability($RoomNumber, $From, $To, $Date);

        if ($blocked == 1)
            redirect_to("Reservation.php?flag=1");
        else if( !is_numeric($Capacity) || !is_numeric($RoomNumber)){
            $_SESSION['RoomNumber'] = $RoomNumber;
            $_SESSION['Date'] = $Date;
            $_SESSION['From'] = $From;
            $_SESSION['To'] = $To;
            $_SESSION['Projector'] = $Projector;
            $_SESSION['Marker'] = $Marker;
            $_SESSION['AC'] = $AC;
            $_SESSION['WhiteBoard'] = $WhiteBoard;
            $_SESSION['Capacity'] = $Capacity;
            redirect_to("Reservation.php?flag=7");
        }
        elseif ($Date < date("Y-m-d")) {
            $_SESSION['RoomNumber'] = $RoomNumber;
            $_SESSION['Date'] = $Date;
            $_SESSION['From'] = $From;
            $_SESSION['To'] = $To;
            $_SESSION['Projector'] = $Projector;
            $_SESSION['Marker'] = $Marker;
            $_SESSION['AC'] = $AC;
            $_SESSION['WhiteBoard'] = $WhiteBoard;
            $_SESSION['Capacity'] = $Capacity;
            redirect_to("Reservation.php?flag=2");
        } elseif ($To < $From) {
            $_SESSION['RoomNumber'] = $RoomNumber;
            $_SESSION['Date'] = $Date;
            $_SESSION['From'] = $From;
            $_SESSION['To'] = $To;
            $_SESSION['Projector'] = $Projector;
            $_SESSION['Marker'] = $Marker;
            $_SESSION['AC'] = $AC;
            $_SESSION['WhiteBoard'] = $WhiteBoard;
            $_SESSION['Capacity'] = $Capacity;
            redirect_to("Reservation.php?flag=3");
        } else if ($count != 0 && $maxCapacity < $Capacity) {
            $_SESSION['RoomNumber'] = $RoomNumber;
            $_SESSION['Date'] = $Date;
            $_SESSION['From'] = $From;
            $_SESSION['To'] = $To;
            $_SESSION['Projector'] = $Projector;
            $_SESSION['Marker'] = $Marker;
            $_SESSION['AC'] = $AC;
            $_SESSION['WhiteBoard'] = $WhiteBoard;
            $_SESSION['Capacity'] = $Capacity;
            redirect_to("Reservation.php?flag=4");
        } else if ($count != 0) {
            //redirect to "Sorry! This room is already reserved by another user."
            $_SESSION['RoomNumber'] = $RoomNumber;
            $_SESSION['Date'] = $Date;
            $_SESSION['From'] = $From;
            $_SESSION['To'] = $To;
            $_SESSION['Projector'] = $Projector;
            $_SESSION['Marker'] = $Marker;
            $_SESSION['AC'] = $AC;
            $_SESSION['WhiteBoard'] = $WhiteBoard;
            $_SESSION['Capacity'] = $Capacity;
            redirect_to("Reservation.php?flag=5");
        } else if ($maxCapacity < $Capacity) {
            $_SESSION['RoomNumber'] = $RoomNumber;
            $_SESSION['Date'] = $Date;
            $_SESSION['From'] = $From;
            $_SESSION['To'] = $To;
            $_SESSION['Projector'] = $Projector;
            $_SESSION['Marker'] = $Marker;
            $_SESSION['AC'] = $AC;
            $_SESSION['WhiteBoard'] = $WhiteBoard;
            $_SESSION['Capacity'] = $Capacity;
            redirect_to("Reservation.php?flag=6");
        } else {
            $result = $reservationController->insertReservation($userID, $RoomNumber, $From, $To, $Projector, $Marker, $WhiteBoard, $AC, $Date, $Capacity);

            if ($result)
                redirect_to("ViewReservation.php?flag=1");
        }
    }
} else {
    redirect_to("LoginPage.php");
}


?>
  