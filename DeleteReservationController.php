<?php session_start(); ?>
<?php function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

?>
<?php

if (!isset($_SESSION['views'])) {
    redirect_to("LoginPage.php");
} else {
    require_once('ReservationTableController.php');
    $controller = ReservationTableController::getReservationTableController();
    $ID = $_GET['id'];
    $result = $controller->deleteReservation($ID);
    if ($result) {
        redirect_to('ViewReservation.php');
    } else
        echo "Error in cancel";
}
?>

