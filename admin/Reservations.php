<?php
function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

session_start();
if (!isset($_SESSION['admin'])) {
    redirect_to("Login.php");
}

if (isset($_GET['flag']))
    $flag = $_GET['flag'];
require_once('../ReservationTableController.php');
$reservationController = ReservationTableController::getReservationTableController();
?>

<!DOCTYPE html>
<html >
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Co-Working Space</title>

    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>

    <!--External fonts-->

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji" rel="stylesheet">

    <script src="js/jquery-3.2.0.min.js"></script>

    <link href="DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>

	<script src="js/datatables.js"></script>
	<link rel="stylesheet" type="text/css" href="css/blocks.css">
	<link rel="stylesheet" href="css/header-user-dropdown.css">


    <script src="../sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../sweetalert/dist/sweetalert.css">


</head>


<body >


<div style="position: relative;">
    <!-- Header Replace it with a header -->
	<?php include("header-user-dropdown.php") ?>
	<br/>
    <h2 style="text-align: center">Reservations</h2>

    <div style="padding-left: 20px; padding-right: 20px;">
        <table id="reservationsTable" class="display" >
            <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Room Number</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Date</th>
                <th>Projectors</th>
                <th>Markers</th>
                <th>Whiteboard</th>
                <th>AC</th>
                <th>Capacity</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody>

            <?php $reservations = $reservationController->getAllReservations();  foreach ($reservations as $reservation){
               echo "<tr><td>".$reservation->getReservationId()."</td>" ;
               echo "<td>".$reservation->getUserId()."</td>" ;
               echo "<td>".$reservation->getRoomNo()."</td>" ;
               echo "<td>".$reservation->getStartTime()."</td>" ;
               echo "<td>".$reservation->getEndTime()."</td>" ;
               echo "<td>".$reservation->getDate()."</td>" ;
               echo "<td>".$reservation->getProjector()."</td>" ;
               echo "<td>".$reservation->getMarkers()."</td>" ;
               echo "<td>".$reservation->getWhiteBoard()."</td>" ;
               echo "<td>".$reservation->getAC()."</td>" ;
               echo "<td>".$reservation->getCapacity()."</td>" ;
               echo " <td style=\"width: 5%;\"><a class=\"btn btn-market full-width btn--with-shadow\" href=\"EditReservation.php?id=".$reservation->getReservationId()."\"style=\"line-height: 0;color:white;\"> Edit </a></td>";
               echo "</tr>";
            }?>

            </tbody>
        </table>
    </div>
</div>
<script>
    javaScriptVar = "<?php echo $flag; ?>";
    if (javaScriptVar === "1") {
        swal("Congrats", "Reservation Edited Successfully ", "success");
    }

</script>
</body>
</html>