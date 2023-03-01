<?php
require_once 'header.php';

use MyProject\Model\Dish;
use MyProject\Model\GalleryImage;

$image_target_dir = 'assets/dishImages';
if ( ! is_dir($image_target_dir)) {
    mkdir($image_target_dir);
}
$image;
$uploadOK = false;
if(($_FILES["dishImage"]["name"])) {
    $imageFileType = strtolower(pathinfo($_FILES["dishImage"]["name"],PATHINFO_EXTENSION));
    $image = $image_target_dir . DIRECTORY_SEPARATOR . basename($_POST['dishTitle'] .'.'. $imageFileType);

    if ($_FILES["dishImage"]["size"] > 1000000) {
        echo '<div class="alert alert-danger"> Le fichier est trop volumineux, il doit faire moins de 1Mo.</div>';
        $uploadOk = false;
    }
    else {
        $uploadOk = true;
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo '<div class="alert alert-danger">Uniquement fichiers JPG, JPEG, PNG & GIF acceptés.</div>';
            $uploadOk = false;

        }
        else {
            $check = getimagesize($_FILES["dishImage"]["tmp_name"]);

            if($check !== false) {
              $uploadOk = true;
            } 
            else {
              echo '<div class="alert alert-danger">Le fichier n\'est pas une image.</div>';
              $uploadOk = false;
            }
        }

    }

    
    


    if ($uploadOk === false) {
        echo "Le fichier n'a pas pu être téléchargé.";
      // if everything is ok, try to upload file
    } 
    else {
        if (move_uploaded_file($_FILES["dishImage"]["tmp_name"], $image)) {
            echo "<div class=\"alert alert-success\">L'image ". htmlspecialchars( basename( $_FILES["dishImage"]["name"])). " a été chargée en tant que " . $image."</div>";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo '
                <div class="article d-flex flex-column align-items-center">
                <h2 class="h2 mb-5">Confirmer la création du plat</h2>
                ';
                
            
                $data = [
                    'title' => isset($_POST['dishTitle']) ? $_POST['dishTitle'] : throw new error("pas de titre"),
                    'price' => isset($_POST['dishPrice']) ? $_POST['dishPrice'] : throw new error("pas de prix"),
                    'isActive' => (isset($_POST['activeDish']) && $_POST['activeDish']=='on') ? true : false,
                    // 'tags' => isset($_POST['tags']) ? $_POST['tags'] : [],
                    'galleryImage' => ($_FILES['dishImage']['name']) ? $image : null,
                ];
                
                
                echo '<ul class="list-group">';
                echo '<li class="list-group-item"><span class="text-secondary bg-primary m-5">Titre: </span> '.$data['title'].'</li>';
                echo '<li class="list-group-item"><span class="text-secondary bg-primary  m-5">Prix: </span> '.$data['price'].' €</li>';
                echo $data['isActive'] ? '<li class="list-group-item"><span class="text-secondary bg-primary m-5">Visible sur la carte ?</span> oui' : '<li class="list-group-item"><span class="text-secondary bg-primary m-5">Visible sur la carte ?</span> non';
                // echo '<p>'.$dish->getTags().'</p>';
                echo '</ul>';
                if ($data['galleryImage']) {
                    echo '<img width="300px" class="mb-3" src="'. ($data['galleryImage']).'">';
                }
                else {
                    echo '<img width="300px"  class="mb-3" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930">';
                }
                echo '<form action="/envoyer-plat" method="POST">';
                echo '<input class="hidden" type=texte value="/envoyer-plat" name="url" id="url">';
                    foreach($data as $key => $value) {
                        echo '<input class="hidden" type=texte value="'.$value.'" name="data['.$key.']" id="'.$key.'">';
                    }
                    echo '<button type="submit" class="btn btn-success m-3">Confirmer</button>';
                    echo '</form>';
                    echo '<button id="cancel" class="btn btn-warning m-3">Annuler</button>';
                echo '</div>';
            }
        } else {
            echo "Erreur de chargement.";
        }
    }
    

}


?>
<script type="text/javascript">
    const tmpUrl = <?= json_encode($image); ?>;
</script>


