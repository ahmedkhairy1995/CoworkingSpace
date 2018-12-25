<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 12/25/2018
 * Time: 7:09 PM
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

require_once('../ContactInfoTableController.php');
$controller = ContactInfoTableController::getContactInfoTableController();
$ID = isset($_GET['id']) ? $_GET['id'] : "";
$result = $controller->deleteContact($ID);
if ($result)
    redirect_to("Contacts.php?flag=2");
else
    redirect_to("Contacts.php?flag=3&id=".$ID);

?>

