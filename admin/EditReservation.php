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
require_once('../ReservationTableController.php');
require_once('../RoomTableController.php');
$reservationController = ReservationTableController::getReservationTableController();
$roomsController = RoomTableController::getRoomTableController();
$reservationId = $_GET['id'];
$flag = -1;
if (isset($_GET['flag']))
    $flag = $_GET['flag'];
$reservation = $reservationController->getReservationById($reservationId);
if (!isset($reservation))
    redirect_to("Overview.php?flag=0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Tool</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <script src="../sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/blocks.css">
    <link rel="stylesheet" href="css/header-user-dropdown.css">
</head>
<body>
<?php include("AdminHeader.php") ?>

<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" name="EditReservationForm" method="post"
                  action="EditReservationController.php"
                  onsubmit="return validateForm()">
					<span class="login100-form-title p-b-49">
						Edit Reservation
					</span>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Reservation Id</span>
                    <input class="input100" type="text" name="reservationID"
                           value="<?php echo $reservation->getReservationId() ?>" readonly>
                </div>
                <br/>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">User Id</span>
                    <input class="input100" type="text" name="userID" value="<?php echo $reservation->getUserId() ?>"
                           readonly>
                </div>
                <br/>

                <div class="wrap-input100 validate-input" data-validate="Room Number is required">
                    <span class="label-input100">Room Number</span>
                    <select name="roomForm">
                        <?php
                        $list = $roomsController->getAllFreeRooms();
                        $i = 0;
                        while ($i < count($list)) {
                            ?>
                            <option value="<?php echo $list[$i]->getRoomID(); ?>"<?php if ($list[$i]->getRoomID() == $reservation->getRoomNo()) {
                                echo "selected";
                            } ?>>
                                <?php echo $list[$i]->getRoomID(); ?>
                            </option>
                            <?php $i++;
                        } ?>
                    </select>
                </div>
                <br/>

                <div class="wrap-input100 validate-input" data-validate="Start time is required">
                    <span class="label-input100">Start Time</span>
                    <input class="input100" name="from" type="time" step="1800" min="12:00" max="22:00"
                           value="<?php echo $reservation->getStartTime() ?>">
                </div>
                <br/>

                <div class="wrap-input100 validate-input" data-validate="Capacity is required">
                    <span class="label-input100">Capacity</span>
                    <input type="number" name="Capacity" min="1" max="50" required
                           value="<?php echo $reservation->getCapacity() ?>"><br><br>
                </div>
                <br/>

                <div class="wrap-input100 validate-input" data-validate="End time is required">
                    <span class="label-input100">End Time</span>
                    <input class="input100" name="to" type="time" step="1800" min="12:00" max="22:00"
                           value="<?php echo $reservation->getEndTime() ?>">
                </div>
                <br/>

                <div class="wrap-input100">
                    <span class="label-input100">Date </span>
                    <input id="DatePicker" type="date" name="reservationDay" max='2019-12-30'
                           value="<?php echo $reservation->getDate() ?>">
                </div>
                <br/>
                <input type="checkbox" id="checkbox1" name="Projector"
                       value="Projector"<?php if ($reservation->getProjector() == 'Yes') echo 'checked'; ?>>Projector
                &nbsp; &nbsp;
                <input type="checkbox" id="checkbox2" name="Markers"
                       value="Markers"<?php if ($reservation->getMarkers() == 'Yes') echo 'checked'; ?>>Markers
                &nbsp; &nbsp;
                <input type="checkbox" id="checkbox3" name="WhiteBoard"
                       value="WhiteBoard"<?php if ($reservation->getWhiteBoard() == 'Yes') echo 'checked'; ?>>WhiteBoard
                &nbsp; &nbsp;
                <input type="checkbox" id="checkbox4" name="AC"
                       value="AC"<?php if ($reservation->getAC() == 'Yes') echo 'checked'; ?>>AC<br><br>


                <div class="text-right p-t-8 p-b-31">

                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <input type="submit" name="submit" class="btn btn-market btn-large btn--with-shadow"
                               value="EDIT" style="width: 100%;text-align: center;">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("DatePicker").setAttribute("min", today);

    const fromTime = document.forms["EditReservationForm"]["from"];
    const toTime = document.forms["EditReservationForm"]["to"];

    function validateForm() {
        if (toTime.value <= fromTime.value) {
            swal("Invalid Time", "From and To times are conflicting", "error");
            return false;
        }
    }

    javaScriptVar = "<?php echo $flag; ?>";

    if (javaScriptVar === "2") {
        swal("Invalid Date", "Please enter valid date ", "error");
    } else if (javaScriptVar === "3") {
        swal("Invalid Time", "Please enter valid time", "error");
    } else if (javaScriptVar === "4") {
        swal("Sorry!", "The room is reserved and the capacity is less than what you need  ", "error");
    } else if (javaScriptVar === "5") {
        swal("Sorry!", "The room is reserved ", "error");
    } else if (javaScriptVar === "6") {
        swal("Sorry!", "The capacity is less than what you need.", "error");
    } else if (javaScriptVar === "7") {
        swal("Sorry!", "The capacity or the room is not a number", "error");
    }
</script>
</body>
</html>
