<?php
function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

?>
<?php
session_start();
if (!isset($_SESSION['admin']))
    redirect_to("Login.php");

require_once('../RoomTableController.php');
$controller = RoomTableController::getRoomTableController();

//Getting passed data
$capacity = isset($_POST["capacity"]) ? $_POST["capacity"] : "";
$status = isset($_POST["status"]) ? $_POST["status"] : "";
$result = $controller->insertRoom($capacity, $status);

if (!is_numeric($Capacity)) {
    redirect_to("AddRoom.php?flag=1");
}
if ($result)
    redirect_to("Rooms.php?flag=2");
else
    redirect_to("AddRoom.php?flag=2");
?>