<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 12/25/2018
 * Time: 7:21 PM
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
$controller = RoomTableController::getRoomTableController();
$ID = isset($_GET['id']) ? $_GET['id'] : "";
$result = $controller->deleteRoom($ID);
if ($result)
    redirect_to("Rooms.php?flag=4");
else
    redirect_to("Rooms.php?flag=3&id=".$ID);

?>
