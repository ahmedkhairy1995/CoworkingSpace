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
require_once('../RoomTableController.php');
$roomsController = RoomTableController::getRoomTableController();
$roomId = $_GET['id'];
$room = $roomsController->getRoomByID($roomId);
if (!isset($room))
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
            <form class="login100-form validate-form" method="post" action="LoginController.php">
					<span class="login100-form-title p-b-49">
						Edit Room
					</span>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Room Id</span>
                    <input class="input100" type="text" name="roomId"
                           value="<?php echo $room->getRoomID() ?>" readonly>
                </div>
                <br/>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Capacity</span>
                    <input class="input100" type="number" max=50 step=1 name="capacity"
                           value="<?php echo $room->getCapacity() ?>">
                </div>
                <br/>

                <div class=" wrap-input100 validate-input" data-validate="Room Number is required">
                    <span class="label-input100">Status</span>
                    <select name="roomNumber">
                        <option value="<?php echo 1 ?>"<?php if ($room->getStatus() == 1) {
                            echo "selected";
                        } ?>>
                            <?php echo "Active"; ?>
                        </option>
                        <option value="<?php echo 0 ?>"<?php if ($room->getStatus() == 0) {
                            echo "selected";
                        } ?>>
                            <?php echo "InActive"; ?>
                        </option>
                    </select>
                </div>
                <br/>

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
