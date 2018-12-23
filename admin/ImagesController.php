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


require_once('../ImagesTableController.php');
$controller = ImagesTableController::getImagesTableController();

if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $insert = $controller->insertImage($imgContent,"/");
        if($insert){
            redirect_to("Images.php?flag=1");
        }else{
            redirect_to("Images.php?flag=2");
        }
    }
    else{
        echo "Please select an image file to upload.";
    }
}
?>
