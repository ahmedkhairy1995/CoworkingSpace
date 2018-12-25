<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 12/22/2018
 * Time: 12:16 AM
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
require_once('../RoomTableController.php');
?>
<?php
$controller = RoomTableController::getRoomTableController();
$ID = isset($_POST['roomId']) ? $_POST['roomId'] : "";
$capacity = isset($_POST['capacity']) ? $_POST['capacity'] : "";
$status = isset($_POST['status']) ? $_POST['status'] : "";
if (!is_numeric($Capacity) || !is_numeric($status)) {
    redirect_to("EditRoom.php?flag=1&id=" . $ID);
}else{
    $result = $controller->updateRoom($ID, $capacity,$status);
    if ($result)
        redirect_to("Rooms.php?flag=1");
    else
        redirect_to("EditRoom.php?flag=2&id=".$ID);

}

?>
