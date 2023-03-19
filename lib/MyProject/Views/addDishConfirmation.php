<?php

use MyProject\Model\Dish;
use MyProject\Model\GalleryImage;

require_once(MYPROJECT_DIR.DIRECTORY_SEPARATOR.'services/aws.php');
require_once(__DIR__.'/../services/security.php');


$image_target_dir = 'assets/dishImages';
if ( ! is_dir($image_target_dir)) {
    mkdir($image_target_dir);
}
$image;
$uploadOK = false;
if(($_FILES["dishImage"]["name"])) {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $imageFileType = strtolower(pathinfo($_FILES["dishImage"]["name"],PATHINFO_EXTENSION));
    $mimeType = $finfo->file($_FILES["dishImage"]["tmp_name"]);
    $image = time()."_".str_replace(" ","-",strtolower(basename(secure($_POST['dishTitle'])) .'.'. $imageFileType));

    if ($_FILES["dishImage"]["size"] > 1000000) {
        echo '<div class="alert alert-danger"> Le fichier est trop volumineux, il doit faire moins de 1Mo.</div>';
        $uploadOk = false;
    }
    else {
        $uploadOk = true;
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && !in_array($mimeType, ['image/jpeg', 'image/png', 'image.gif'])) {
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
        die();
      // if everything is ok, try to upload file
    } 
    else {
        try {
            $upload = $s3->putObject([
                'Bucket'=> $bucket, 
                'Key' => $image, 
                'SourceFile' => $_FILES['dishImage']['tmp_name']
            ]);
            echo "<div class=\"alert alert-success\">L'image ". $image." a été chargée avec succès</div>";
            $imageURL = htmlspecialchars($upload->get('ObjectURL'));
        }
        catch(Exception $e) {
            echo 'probleme de téléchargement de l\'image';
            print($e);
        }

    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '
    <div class="article d-flex flex-column align-items-center">
    <h2 class="h2 mb-5">Confirmer la création du plat</h2>
    ';
    

    $data = [
        'title' => isset($_POST['dishTitle']) ? ucwords(secure($_POST['dishTitle'])) : throw new RuntimeException("pas de titre"),
        'price' => isset($_POST['dishPrice']) ? secure($_POST['dishPrice']) : throw new RuntimeException("pas de prix"),
        'isActive' => (isset($_POST['activeDish']) && secure($_POST['activeDish'])=='on') ? true : false,
        // 'tags' => isset($_POST['tags']) ? $_POST['tags'] : [],
        'galleryImage' => ($_FILES['dishImage']['name']) ? $imageURL : null,
        'category' => isset($_POST['category']) ? secure($_POST['category']) : throw new RuntimeException("pas de categorie")
    ];
    
    
    echo '<ul class="list-group">';
    echo '<li class="list-group-item"><span class="text-secondary bg-primary m-5">Titre: </span> '.$data['title'].'</li>';
    echo '<li class="list-group-item"><span class="text-secondary bg-primary  m-5">Prix: </span> '.$data['price'].' €</li>';
    echo '<li class="list-group-item"><span class="text-secondary bg-primary  m-5">Catégorie: </span> '.$data['category'].'</li>';
    echo $data['isActive'] ? '<li class="list-group-item"><span class="text-secondary bg-primary m-5">Visible sur la carte ?</span> oui' : '<li class="list-group-item"><span class="text-secondary bg-primary m-5">Visible sur la carte ?</span> non';
    // echo '<p>'.$dish->getTags().'</p>';
    echo '</ul>';
    if ($data['galleryImage']) {
        echo '<img width="300px" class="mb-3" src="'. ($data['galleryImage']).'">';
    }
    else {
        echo '<img width="300px"  class="mb-3" src="'.ASSETS.DIRECTORY_SEPARATOR.'no-image.png">';
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


?>
<script type="text/javascript">
    const tmpUrl = <?= json_encode($imageURL); ?>;
</script>


