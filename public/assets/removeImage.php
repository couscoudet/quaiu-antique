<?php
require_once('../index.php');
require_once(MYPROJECT_DIR.DIRECTORY_SEPARATOR.'services/aws.php');

$url = $_POST['url'];
$key = explode('.com/',$url)[1];
                try {
                    $result = $s3->deleteObject([
                        'Bucket' => $bucket,
                        'Key' => $key
                    ]);
                    echo 'suppression image';
                }
                catch(S3Exception $e){
                        exit("Erreur : " . $e->getAwsErrorMessage() . PHP_EOL);
                }
?>