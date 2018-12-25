<?php
session_start();
if (isset($_GET['flag']))
    $flag = $_GET['flag'];
require_once('ContactInfoTableController.php');
require_once('ImagesTableController.php');
?>

<?php
$contactInfoController = ContactInfoTableController::getContactInfoTableController();
$imagesTableController = ImagesTableController::getImagesTableController();
$contacts = $contactInfoController->getAllContacts();
$images = $imagesTableController->getImages();
$imagesEncoded = array();
$i = 0;
while ($i < count($images)) {
    $imagesEncoded[$i] = base64_encode($images[$i]);
    $i++;
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
    <title>Homepage</title>
    <!-- Minified CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <!--Applying an external stylesheet-->
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link rel="stylesheet" href="css/component.css">
    <link rel="stylesheet" type="text/css" href="css/style2.css">

    <script src="sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">

</head>

<body>

<!--logo of the co-working space-->
<img id="Logo" src="logo.jpg" alt="Logo">
<!--Main Menu Navigation Tabs-->
<div id="MenuTab">
    <nav id="MainMenuNavigation" class="nav nav-tabs-justified">
        <div class="cl-effect-14">
            <a href="Homepage.php" title="Homepage" role="button">Homepage</a>
            <a href="Reservation.php" title="" role="button">Book A Room</a>
            <a href="ViewReservation.php" title="" role="button">My Reservations</a>
            <a href="AboutUs.php" title="" role="button">About Us</a>
            <?php
            if (!isset($_SESSION['views']))
            {
                ?>
                <a href="LoginPage.php" title="" role="button">Login</a>
                <?php
            }
            else
            {
            ?>
            <div class="dropdown">
                <a href="" title="" class="btn" role="button" data-toggle="dropdown" id="menu" aria-haspopup="true"
                   aria-expanded="true">
                    <?php echo $_SESSION['name'] ?>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="menu">
                    <li><a href="EditProfile.php" title="">Edit Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="LogOut.php" title="" id="logout">Logout</a></li>
                </ul>
            </div>
        </div>
        <?php
        }
        ?>
    </nav>
</div>
<section class="MainSection">
    <h1 class="Title">CoworkingSpace</h1>
    <p class="Description">Not just an office but a community of networks that help you make your DREAMS come true</p>
</section>

<aside>
    <div class ="ourImageContainer">
    <img src="" id="Pic" alt="Ebda3 Pictures" class="img img-responsive center-block"  width="100%" height="100%">
    </div>
</aside>

<?php include("Footer.php")?>
<script>
    /*swal({
          title: "Good Evening!",
          text: "Ebda3's website, where you can get 10 LE discount 10 times",
          imageUrl: "logo.jpg",
          timer: 1000
        });*/
</script>
<script>
    javaScriptVar = "<?php echo $flag; ?>";
    if (javaScriptVar === "1") {
        swal("Congrats", "You signed up", "success");
    }
    if (javaScriptVar === "2") {
        swal("Info Updated", "We have updated your info", "success");
    }
    if (javaScriptVar === "3") {
        swal("Sent", "Recovery email was sent", "success");
    }
    if (javaScriptVar === "4") {
        swal("Error", "Try again later", "error");
    }
    if (javaScriptVar === "5") {
        swal("Invalid Email", "This email doesnot exist", "error");
    }
</script>
<!--Applying an external javascript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script><!--applying jQuery library-->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script>src = "js/bootstrap.js"</script>
<script>src = "js/jquery-3.2.0.js"</script>
<script>

    window.onload = function () {
        Image = document.getElementById("Pic");
        ImageArray =<?php echo json_encode($imagesEncoded); ?>;
        ImageIndex = 0;
        Image.setAttribute("src", "data:image/*;base64,"+ImageArray[ImageIndex]);
        var IntervalHandler = setInterval(SlideShow, 3000);
        $('.ourImageContainer').find('img').each(function(){
        var imgClass = (this.width/this.height < 1) ? 'wide' : 'tall';
        $(this).addClass(imgClass);
        })
    };

    //Slide Show
    function SlideShow() {
        Image.setAttribute("src", "data:image/*;base64,"+ImageArray[ImageIndex]);
        ImageIndex++;
        if (ImageIndex >= ImageArray.length) {
            ImageIndex = 0;
        }
        $('.ourImageContainer').find('img').each(function(){
        var imgClass = (this.width/this.height < 1) ? 'wide' : 'tall';
        $(this).addClass(imgClass);
        })
    }
</script>
</body>
</html>