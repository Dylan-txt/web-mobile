<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monuments de France</title>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="styles.css">
    

</head>
<body>
    <header>
        <div><h4>Monuments de France</h4></div>         
        <?php
            include_once('header/header.php');
        ?>
    </header>
    <main>
    <div class="container">
        <div id="map"></div>
        <div id="sidebar">
            <ul id="monuments-list"></ul>
        </div>
        <div class="hideSide"><button id="hideSidebar">Masquer les monuments</button></div>
    </div>
    <div id="monument-details">
    </div>
    <div id="comments-section">
    <ul id="comments-list"></ul>
</div>

</main>


<script> const userId = <?php echo json_encode($user->idUser); ?>;</script>
    <script src="script.js"></script>
</body>
</html>
