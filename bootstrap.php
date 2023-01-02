<?php

require_once "vendor/autoload.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$paths = [__DIR__ . '/src'];
$isDevMode = false;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: $paths,
    isDevMode: $isDevMode
);

$dbParams = [
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => '',
    'dbname' => 'quai_antique',
    'host' => 'localhost'
];

$conn = DriverManager::getConnection($dbParams);

$entityManager = new EntityManager($conn, $config);

\Doctrine\DBAL\Types\Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');
