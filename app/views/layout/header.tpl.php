<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= $baseUri ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $baseUri ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= $baseUri ?>assets/css/styles.css">
    <title>oShop</title>
</head>

<body>
    <header>
        <?php
            if (isset($_SESSION['connectedUser'])) :
                include __DIR__.'/../partials/backnav.tpl.php';
            else :
                include __DIR__.'/../partials/nav.tpl.php';
            endif;
        ?>
    </header>