<?php
session_start();
$flag = -1;
if (isset($_GET['flag']))
    $flag = $_GET['flag'];
?>

<?php
require_once('ContactInfoTableController.php');
require_once('RoomTableController.php');

$contactInfoController = ContactInfoTableController::getContactInfoTableController();
$roomsController = RoomTableController::getRoomTableController();
$contacts = $contactInfoController->getAllContacts();

?>
<?php function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

?>
<?php if (!isset($_SESSION['views'])) {
    redirect_to("LoginPage.php");
}
?>

<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <!-- IE Edge Meta Tag -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Viewport -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Book a room"/>
    <title>Book a room</title>
    <!--Applying an external stylesheet-->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link rel="stylesheet" href="css/component.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link rel="stylesheet" type="text/css" href="css/style2.css">
</head>

<body>
<?php include("Header.php") ?>
<div id="BookARoomSpan">
    <span>Book a room</span>
</div>

<div id="_BookARoom">
    <!--Creating A Form-->
    <!--The action attribute defines the action to be performed when the form is submitted.
    Normally, the form data is sent to a web page on the server when the user clicks on the submit button.
    In the example above, the form data is sent to a page on the server called "/action_page.php". This page contains a server-side script that handles the form data-->
    <form id="BookARoom" name="LoginForm" action="ReservationController.php" method="post">
        <p><strong>Room</strong></p>
        <select name="roomForm">
            <?php
            $list = $roomsController->getAllFreeRooms();
            $i = 0;
            while ($i < count($list)) {
                ?>
                <option value="<?php echo $list[$i]->getRoomID(); ?>">
                    <?php echo $list[$i]->getRoomID(); ?>
                </option>
                <?php $i++;
            } ?>

        </select><br><br>

        <p><strong>Date</strong><i style="color:dimgrey;">&nbsp &nbsp (yyyy-mm-dd)</i></p>
        <input id="DatePicker" type="date" name="reservationDay" max='2019-12-30'
               value="<?php if (isset($_SESSION['Date'])) echo $_SESSION['Date']; ?>"><br><br>

        <p><strong>Capacity</strong></p>
        <input type="number" name="Capacity"
               value="<?php if (isset($_SESSION['Capacity'])) echo $_SESSION['Capacity']; ?>" min="1" max="10" required><br><br>

        <p><strong>From</strong><i style="color:dimgrey;">&nbsp Price per hour: 5 EGP</i></p>
        <input type="time" name="from" value="<?php if (isset($_SESSION['From'])) echo $_SESSION['From']; ?>"
               step="1800" min="12:00" max="22:00">

        <p><strong>To</strong></p>
        <input type="time" name="to" value="<?php if (isset($_SESSION['To'])) echo $_SESSION['To']; ?>" step="1800"
               min="12:30" max="23:00"><br><br>

        <p><strong>Additionals</strong></p>
        <input type="checkbox" id="checkbox1" name="Projector" value="Projector" <?php if (isset($_SESSION['To'])) {
            if ($_SESSION['Projector'] == "Yes") echo "checked";
        } ?> >Projector
        &nbsp; &nbsp;
        <input type="checkbox" id="checkbox2" name="Markers" value="Markers" <?php if (isset($_SESSION['Marker'])) {
            if ($_SESSION['Marker'] == "Yes") echo "checked";
        } ?>>Markers
        &nbsp; &nbsp;
        <input type="checkbox" id="checkbox3" name="WhiteBoard"
               value="WhiteBoard"<?php if (isset($_SESSION['WhiteBoard'])) {
            if ($_SESSION['WhiteBoard'] == "Yes") echo "checked";
        } ?>>WhiteBoard
        &nbsp; &nbsp;
        <input type="checkbox" id="checkbox4" name="AC" value="AC" <?php if (isset($_SESSION['AC'])) {
            if ($_SESSION['AC'] == "Yes") echo "checked";
        } ?>>AC<br><br>

        <!--<input type="submit"> defines a button for submitting form data to a form-handler.
The form-handler is typically a server page with a script for processing input data.-->
        <input type="submit" name="checkAvailability" value="Check Availability">
        <br><br>

    </form>
</div>

<?php include("Footer.php") ?>
<!--Applying an external javascript-->
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("DatePicker").setAttribute("min", today);

    javaScriptVar = "<?php if (isset($flag)) echo $flag; ?>";

    if (javaScriptVar === "1") {
        swal("Blocked User", "Please contact the admin ", "error");
    } else if (javaScriptVar === "2") {
        swal("Invalid Date", "Please enter valid date ", "error");
    } else if (javaScriptVar === "3") {
        swal("Invalid Time", "Please enter valid time", "error");
    } else if (javaScriptVar === "4") {
        swal("Sorry!", "The room is reserved and the capacity is less than what you need  ", "error");
    } else if (javaScriptVar === "5") {
        swal("Sorry!", "The room is reserved ", "error");
    } else if (javaScriptVar === "6") {
        swal("Sorry!", "The capacity is less than what you need.", "error");
    } else if (javaScriptVar === "7") {
        swal("Sorry!", "The capacity or the room is not a number", "error");
    }
</script>
</body>
</html>