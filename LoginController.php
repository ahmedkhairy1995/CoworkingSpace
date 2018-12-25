<?php
function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

?>
<?php session_start(); ?>

<?php
require_once('ReservationTableController.php');
require_once('RoomTableController.php');
require_once('ValidationController.php');
require_once('UsersTableController.php');
require_once('User.php');
$userController = UsersTableController::getUsersTableController();
$validationController = ValidationController::getValidationController();

$Email = isset($_POST["Email"]) ? $_POST["Email"] : "";
$Password = isset($_POST["Password"]) ? $_POST["Password"] : "";
if (!$validationController->validateEmail($Email)) {
    redirect_to("LoginPage.php?flag=1");

}
else if (!$validationController->validatePassword($Password) ){
    redirect_to("LoginPage.php?flag=2");

}

$Password = md5($Password);
$user = $userController->getUserByEmail($Email);

if ($user != Null) {
    $dbPassword = $user->getPassword();

    if ($Password == $dbPassword) {
        $_SESSION['views'] = $user->getEmail();
        $_SESSION['name'] = $user->getFirstName();
        redirect_to("Homepage.php");
    } else
        redirect_to("LoginPage.php?flag=42");

} else
    redirect_to("LoginPage.php?flag=41");

?>
