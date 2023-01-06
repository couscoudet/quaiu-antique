<?php

require_once "vendor/autoload.php";

if ($_ENV === []) {
    require_once "dotenv.php";
}

//Doctrine connexion conf
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
    'user' => ($_ENV['ENV_TYPE'] && $_ENV['ENV_TYPE']=='dev') ? $_ENV['DB_USER_DEV'] : $_ENV['DB_USER'],
    'password' => ($_ENV['ENV_TYPE'] && $_ENV['ENV_TYPE']=='dev') ? $_ENV['DB_PASSWORD_DEV'] : $_ENV['DB_PASSWORD'],
    'dbname' => ($_ENV['ENV_TYPE'] && $_ENV['ENV_TYPE']=='dev') ? $_ENV['DB_NAME_DEV'] : $_ENV['DB_NAME'],
    'host' => ($_ENV['ENV_TYPE'] && $_ENV['ENV_TYPE']=='dev') ? $_ENV['DB_HOST_DEV'] : $_ENV['DB_HOST'],
    'server_version' => 'mariad-db-10.4.24'
];

$conn = DriverManager::getConnection($dbParams);

$entityManager = new EntityManager($conn, $config);

\Doctrine\DBAL\Types\Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');
