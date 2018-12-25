<?php
function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

if (isset($_GET['flag']))
    $flag = $_GET['flag'];
session_start();
if (!isset($_SESSION['admin'])) {
    redirect_to("Login.php");
}
require_once('../UsersTableController.php');
$userController = UsersTableController::getUsersTableController();
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
	<?php include("AdminHeader.php") ?>
	<br/>
    <h2 style="text-align: center">Customers</h2>

    <div style="padding-left: 20px; padding-right: 20px;">
        <table id="customersTable" class="display" >
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>Mobile Number</th>
                <th>Address</th>
                <th>Blocked</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody>
			<!-- for each loop -->
            <?php $users = $userController->getAllUsers();  foreach ($users as $user){
                echo "<tr><td>".$user->getId()."</td>" ;
                echo "<td>".$user->getFirstName()."</td>" ;
                echo "<td>".$user->getLastName()."</td>" ;
                echo "<td>".$user->getEmail()."</td>" ;
                echo "<td>".$user->getBirthday()."</td>" ;
                echo "<td>".$user->getGender()."</td>" ;
                echo "<td>".$user->getMobileNumber()."</td>" ;
                echo "<td>".$user->getAddress()."</td>" ;
                echo "<td>".$user->getBlocked()."</td>" ;
                echo " <td style=\"width: 5%;\"><a class=\"btn btn-market full-width btn--with-shadow\" href=\"EditCustomer.php?id=".$user->getId()."\" style=\"line-height: 0;color:white;\"> Edit </a></td>";
                echo "</tr>";
            }?>


            </tbody>
        </table>
    </div>
</div>
<script>
    javaScriptVar = "<?php echo $flag; ?>";
    if (javaScriptVar === "1") {
        swal("Congrats", "Customer Edited Successfully ", "success");
    }

</script>
</body>
</html>