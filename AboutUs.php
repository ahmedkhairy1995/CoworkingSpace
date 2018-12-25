<?php
session_start();
if (isset($_GET['flag']))
    $flag = $_GET['flag'];
require_once('ImagesTableController.php');
require_once('ContactInfoTableController.php');

$contactInfoController = ContactInfoTableController::getContactInfoTableController();
$imagesTableController = ImagesTableController::getImagesTableController();
$images = $imagesTableController->getImages();
$contacts = $contactInfoController->getAllContacts();
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

    <meta name="description" content="Ebda3 Co-Working space.One of the leading coworking spaces in Egypt"/>
    <title>About Us</title>
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

<?php include("Header.php") ?>
<form>
    <fieldset>
        <div id="AboutUsDiv">
            <legend>About Us</legend>
            <div id="AboutUs">
                <h1>Story</h1>
                <h3>CoworkingSpace is a training center established by group of students that have the passion of
                    building and benefiting their community, through providing the students with needed courses for
                    their field with affordable prices. Our contribution to the society is through developing the
                    capability, way of thinking and skills needed to perform effectively.</h3>

                <h1>Mission</h1>
                <h3>"EBDA3" is our mission.
                    We simply aim to develop the way of thinking, working and performing of any task.
                    How is this achieved?
                    By providing our applicants with courses tutored by professional certified
                    instructors. Some of the courses include workshops which assure the development. Plus, we also have
                    a fully equipped computer laboratory with the latest technology, where applicants can learn and
                    practice their new skills.
                    Our goal is simple, yet extremely efficient.</h3>
            </div>

            <div id="slideshow">
                <div class="ourImageContainer">
                    <img src="" id="Pic" alt="Ebda3 Pictures" class="img img-responsive center-block">
                </div>
            </div>
        </div>
    </fieldset>
</form>
<?php include("Footer.php") ?>

<script>
    var Image = document.getElementById("Pic");
    var ImageArray =<?php echo json_encode($imagesEncoded); ?>;
    var ImageIndex = 0;
    window.onload = function () {

        Image.setAttribute("src", "data:image/*;base64," + ImageArray[ImageIndex]);
    };
    $('.ourImageContainer').find('img').each(function () {
        var imgClass = (this.width / this.height < 1) ? 'wide' : 'tall';
        $(this).addClass(imgClass);
    })
    var Image = document.getElementById("Pic");
    //Implementing a slideshow

    var ImageArray =<?php echo json_encode($imagesEncoded); ?>;
    var ImageIndex = 0;

    function SlideShow() {
        Image.setAttribute("src", "data:image/*;base64," + ImageArray[ImageIndex]);
        ImageIndex++;
        if (ImageIndex >= ImageArray.length) {
            ImageIndex = 0;
        }
        $('.ourImageContainer').find('img').each(function () {
            var imgClass = (this.width / this.height < 1) ? 'wide' : 'tall';
            $(this).addClass(imgClass);
        })
    }

    var IntervalHandler = setInterval(SlideShow, 3000);

</script>

<script>
    swal({
        title: "Good Evening!",
        text: "Ebda3's website, where you can get 10 LE discount 10 times",
        imageUrl: "logo.jpg",
        timer: 10000
    });
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

    var javaScriptVar = "<?php echo $flag; ?>";
    if (javaScriptVar == "1") {
        swal("Congrats", "You signed up", "success");
    }
</script>


</body>
</html>