<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <?php 
    include_once('header/header.php');
    ?>
</header>

<main>
<h1>Menu Principal</h1>

    <h2>Choisissez une ville :</h2>
    <ul>
        <li><a href="monuments.php?ville=paris">Paris</a></li>
        <li><a href="monuments.php?ville=marseille">Marseille</a></li>
        <li><a href="monuments.php?ville=lyon">Lyon</a></li>
    </ul>
</main>

</body>
</html>
