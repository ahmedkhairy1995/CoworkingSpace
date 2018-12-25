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
require_once('../ContactInfoTableController.php');
$contactController = ContactInfoTableController::getContactInfoTableController();
?>

<!DOCTYPE html>
<html>
<head>
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


<body>


<div style="position: relative;">
    <!-- Header Replace it with a header -->
    <?php include("header-user-dropdown.php") ?>
    <br/>
    <h2 style="text-align: center">Contacts</h2>

    <div style="padding-left: 20px; padding-right: 20px;">
        <table id="contactsTable" class="display">
            <a class="btn btn-market full-width btn--with-shadow" href="AddContact.php"
               style="line-height: 0;color:white;margin-bottom: 10px; float: right !important;"> Add </a>
            <thead>
            <tr>
                <th>ID</th>
                <th>Contact Number</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <!-- for each loop -->
            <?php $contacts = $contactController->getAllContacts();
            foreach ($contacts as $contact) {
                echo "<tr><td>" . $contact->getId() . "</td>";
                echo "<td>" . $contact->getContactNum() . "</td>";
                echo " <td style=\"width: 5%;\"><a class=\"btn btn-market full-width btn--with-shadow\" href=\"DeleteContactController.php?id=" . $contact->getId() . "\" style=\"line-height: 0;color:white;\"> Delete </a></td>";
                echo "</tr>";
            } ?>


            </tbody>
        </table>
    </div>
</div>
<script>
    javaScriptVar = "<?php echo $flag; ?>";
    if (javaScriptVar === "1") {
        swal("Congrats", "Contact Edited Successfully ", "success");
    }
    else if (javaScriptVar === "2") {
        swal("Congrats", "Contact Deleted Successfully ", "success");
    }
    else if (javaScriptVar === "3") {
        swal("Error", "Can't delete contact try again! ", "error");
    }

</script>
</body>
</html>