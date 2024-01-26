<?php 
    require_once('connexion/user.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monuments de Paris</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    

</head>
<body>

    <header>
        <h1>Monuments de Paris</h1>         
        <?php
            session_start();
            if (!empty($_SESSION['User'])) {
                $user = $_SESSION['User'];
                echo '<p>Bienvenue, ' . $user->loginName . '!</p>';
                echo '<a href="connexion/logout.php" class="logout-button">Déconnexion</a>';
            } else {
                echo '<a href="connexion/connexion.html" class="login-button">Connexion</a>';
            }
        ?>
    </header>

    <main>
        <ul id="monuments-list"></ul>
        <div id="monument-details"></div>
        <div id="map" style="height: 300px;"></div>

    </main>


    <script src="script.js"></script>
</body>
</html>
