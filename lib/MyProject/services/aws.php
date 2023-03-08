<?php

use Aws\S3\S3Client;
use Aws\S3\ObjectUploader;

$options = [
    'region' => 'eu-west-3',
    'version' => 'latest',
    'credentials' => [
	    'key'    => $_ENV['AWS_ACCESS_KEY_ID'],
	    'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
	]
];

$s3 = new S3Client($options);

$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');

?>