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
require_once('../ImagesTableController.php');
$controller = ImagesTableController::getImagesTableController();
$images = $controller->getAllImages();
$count = $controller->getImagesCount();
?>

<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Co-working Space</title>

    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/header-user-dropdown.css">
    <link rel="stylesheet" type="text/css" href="css/blocks.css">

    <!-- <script src="../sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="../sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../sweetalert/dist/sweetalert.css">

</head>

<body>
<div style="position: relative;">
    <!-- Header Replace it with a header -->
    <?php include("header-user-dropdown.php"); ?>
    <br/>
    <div class="container">

        <div class="page-header">
            <h2 style="text-align: center">Images</h2>
        </div>
        <form action="ImagesController.php" method="POST" enctype="multipart/form-data">
            <input class="fileUpload" type="file" name="image" accept="image/*" required="required"
                   style="width: 25%; margin-right: 1%; margin-left: 1%;">
            <input type="submit" name="submit" class="btn btn-market btn--with-shadow" value="UPLOAD">
            </button>
        </form>

        <br/>

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <?php for ($x = 1; $x < $count; $x++) {
                    echo "<li data-target='#carousel-example-generic' data-slide-to='" . $x . "'></li>";
                } ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php $x = 0;
                foreach ($images as $image) {
                    # code...
                    if ($x == 0) {
                        echo "<div class=\"carousel-item active\">
                        <a class='btn btn-market full-width btn--with-shadow' href='DeleteImageController.php?id=" . $image->getImageId() . "'style ='line-height: 0;color:white;float:right;'> Delete </a >
                        <img src='data:image/*;base64," . base64_encode($image->getImage()) . "'>
                              </div>";
                    } else {
                        echo "<div class=\"carousel-item\">
                                        <a class='btn btn-market full-width btn--with-shadow' href='DeleteImageController.php?id=" . $image->getImageId() . "'style ='line-height: 0;color:white;float:right;'> Delete </a >
                                        <img src='data:image/*;base64," . base64_encode($image->getImage()) . "'>
                                    </div>";
                    }
                    $x++;

                } ?>

            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>
    <script>
        javaScriptVar = "<?php echo $flag; ?>";

        if (javaScriptVar === "4") {
            swal("Congrats", "Image Deleted Successfully ", "success");
        }else if (javaScriptVar === "1") {
            swal("Congrats", "Image Uploaded Successfully ", "success");
        }
        else if (javaScriptVar === "2") {
            swal("Error", "Can't upload Image try again! ", "error");
        }
        else if (javaScriptVar === "3") {
            swal("Error", "Can't delete Image try again! ", "error");
        }

    </script>
</body>
</html>