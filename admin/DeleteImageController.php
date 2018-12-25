<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 12/25/2018
 * Time: 7:55 PM
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

require_once('../ImagesTableController.php');
$controller = ImagesTableController::getImagesTableController();
$ID = isset($_GET['id']) ? $_GET['id'] : "";
$result = $controller->deleteImage($ID);
if ($result)
    redirect_to("Images.php?flag=4");
else
    redirect_to("Images.php?flag=3");

?>