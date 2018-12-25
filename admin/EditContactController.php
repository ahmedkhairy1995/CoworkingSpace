<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 12/22/2018
 * Time: 12:11 AM
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
require_once('../ValidationController.php');

$controller = ContactInfoTableController::getContactInfoTableController();
$validationController = ValidationController::getValidationController();
$ID = isset($_POST['contactId']) ? $_POST['contactId'] : "";
$contactNum = isset($_POST['contactNum']) ? $_POST['contactNum'] : "";

if(!$validationController->validateMobile($contactNum))
    redirect_to("EditContact.php?flag=1&id=".$ID);
else{
    $result = $controller->updateContact($ID, $contactNum);
    if ($result)
        redirect_to("Contacts.php?flag=1");
    else
        redirect_to("EditContact.php?flag=2&id=".$ID);

}

?>
