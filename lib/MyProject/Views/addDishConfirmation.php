<?php
require_once 'header.php';

use MyProject\Model\Dish;
use MyProject\Model\GalleryImage;

$image_target_dir = 'assets/dishImages';
if ( ! is_dir($image_target_dir)) {
    mkdir($image_target_dir);
}
$galleryImage;
$uploadOK = false;
if(($_FILES["dishImage"]["name"])) {
    echo "j'ai une image !!<br>";
    $imageFileType = strtolower(pathinfo($_FILES["dishImage"]["name"],PATHINFO_EXTENSION));
    $image = $image_target_dir . DIRECTORY_SEPARATOR . basename($_POST['dishTitle'] .'.'. $imageFileType);

    if ($_FILES["dishImage"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
    }
    else {
        $uploadOk = true;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = false;
    }
    else {
        $uploadOk = true;
    }
    
    $check = getimagesize($_FILES["dishImage"]["tmp_name"]);

    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = true;
    } 
    else {
      echo "File is not an image.";
      $uploadOk = false;
    }
    var_dump($uploadOK);
    if ($uploadOk === false) {
        echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
    } 
    else {
        if (move_uploaded_file($_FILES["dishImage"]["tmp_name"], $image)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["dishImage"]["name"])). " has been uploaded as " . $image;
            $galleryImage = new GalleryImage;
            $galleryImage->setImageURL($image);
            $galleryImage->setIsActive(false);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '
    <div class="article d-flex flex-column align-items-center">
    <h2 class="h2 mb-5">Confirmer la création du plat</h2>
    ';
    $dish = new Dish();
    $data = [
        'title' => isset($_POST['dishTitle']) ? $_POST['dishTitle'] : throw new error("pas de titre"),
        'price' => isset($_POST['dishPrice']) ? $_POST['dishPrice'] : throw new error("pas de prix"),
        'isActive' => (isset($_POST['activeDish']) && $_POST['activeDish']=='on') ? true : false,
        // 'tags' => isset($_POST['tags']) ? $_POST['tags'] : [],
        'galleryImage' => isset($galleryImage) ? $galleryImage : null
    ];
    $dish->hydrate($data);
    echo '<ul class="list-group">';
    echo '<li class="list-group-item"><span class="text-secondary bg-primary m-5">Titre: </span> '.$dish->getTitle().'</li>';
    echo '<li class="list-group-item"><span class="text-secondary bg-primary  m-5">Prix: </span> '.$dish->getPrice().' €</li>';
    echo $dish->getIsActive() ? '<li class="list-group-item"><span class="text-secondary bg-primary m-5">Visible sur la carte ?</span> oui' : '<li class="list-group-item"><span class="text-secondary bg-primary m-5">Visible sur la carte ?</span> non';
    // echo '<p>'.$dish->getTags().'</p>';
    echo '</ul>';
    if ($dish->getGalleryImage()) {
        echo '<img width="300px" class="mb-3" src="'. ($dish->getGalleryImage()->getImageURL()).'">';
    }
    else {
        echo '<img width="300px"  class="mb-3" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930">';
    }
    echo '<button id="confirm" type="button" class="btn btn-success mb-3">Confirmer</button>';
    echo '<button type="button" class="btn btn-warning">Annuler</button>';
    echo '
    </div>
    ';
    
}
?>

<script>
    const loadPage = async(page) => {
        const response = await fetch(page,{
            method: 'POST',
            body: 
        })
        .then(function(response) {
            return response.text();
        })
        .then(function(body) {
            document.querySelector('body').innerHTML = body;
        });
    }
    const confirmButton = document.getElementById("confirm");
    confirmButton.addEventListener('click', ()=>{loadPage('/dishToDatabase')})
</script>