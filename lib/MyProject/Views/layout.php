<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= ASSETS.DIRECTORY_SEPARATOR.'custom.css'?>" rel="stylesheet">
    <title>Le quai antique</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
    <header>
    <?php require_once('header.php') ?>
    </header>

    <main>
        <?php echo $content; ?>
    </main>

    <footer>

    </footer>

    <script src="/assets/bootstrap.bundle.min.js"></script>
    <script src="/assets/script.js"></script>
</body>
</html>