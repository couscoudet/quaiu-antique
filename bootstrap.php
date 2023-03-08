<?php

require_once "vendor/autoload.php";

//require dotenv vulcas package only in development
if ($_ENV === []) {
    require_once "dotenv.php";
}


//Amazon AWS Image Bucket

//Doctrine connexion conf
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;

$applicationMode = "development";

if ($applicationMode == "development") {
    $queryCache = new ArrayAdapter();
    $metadataCache = new ArrayAdapter();
} else {
    $queryCache = new PhpFilesAdapter('doctrine_queries');
    $metadataCache = new PhpFilesAdapter('doctrine_metadata');
}

$config = new Configuration;
$config->setMetadataCache($metadataCache);
$driverImpl = new AttributeDriver([__DIR__.'/lib/MyProject/Entities']);
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCache($queryCache);
$config->setProxyDir(__DIR__.'/lib/MyProject/Proxies');
$config->setProxyNamespace('MyProject\Proxies');

// if ($applicationMode == "development") {
//     $config->setAutoGenerateProxyClasses(true);
// } else {
//     $config->setAutoGenerateProxyClasses(false);
// }


// $paths = [__DIR__ . '/lib/MyProject/Entities'];
// $isDevMode = false;

// $config = ORMSetup::createAttributeMetadataConfiguration(
//     paths: $paths,
//     isDevMode: $isDevMode
// );

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