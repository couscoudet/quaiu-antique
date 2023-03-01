<?php

$url = $_POST['url'];
unlink('../'.$url);
echo 'suppression image';
?>

<img src="<?= $url ?>">