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
    <link rel="icon" type="image/png" href="/images/icons/favicon.ico"/>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="css/header-user-dropdown.css">
</head>
<body>
<?php include("header-user-dropdown.php") ?>

<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" method="post" action="../EditResController.php">
					<span class="login100-form-title p-b-49">
						Edit Reservation
					</span>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Reservation Id</span>
                    <input class="input100" type="text" name="reservationID"
                           value="<?php echo $reservation->getReservationId() ?>" disabled>
                </div>
                <br/>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">User Id</span>
                    <input class="input100" type="text" name="userID" value="<?php echo $reservation->getUserId() ?>"
                           disabled>
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
                    <input id="DatePicker" type="date" name="reservationDay"
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
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Edit
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
