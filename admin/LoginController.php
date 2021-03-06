<?php

function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

session_start();
include('AdminTableController.php');
$adminController = AdminTableController::getAdminTableController();

require_once('../ValidationController.php');
$validationController = ValidationController::getValidationController();
$username = isset($_POST['username']) ? $_POST['username']: "" ;
$password = isset($_POST['password']) ? $_POST['password']: "";
if (!$validationController->validateName($username)) {
    redirect_to("LoginPage.php?flag=3");

} else if (!$validationController->validatePassword($password) ){
    redirect_to("Login.php?flag=2");

}

$result = $adminController->authenticate($username,$password);

if(isset($result))
{
    $_SESSION['admin'] = $result;
    redirect_to("Overview.php");
}
else{
    redirect_to("Login.php?flag=1");
}

?>