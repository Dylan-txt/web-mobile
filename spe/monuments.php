<?php // Load language files
$lang = 'fr';
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
}

$lang_file = 'lang/'.$lang . '.json';
$lang_data = json_decode(file_get_contents($lang_file), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monuments de France</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    

</head>
<body>

<?php
            include_once('header/header.php');
        ?>
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
</div>

</main>

<script>
    const lang = '<?php echo $lang; ?>';
    const langData = <?php echo json_encode($lang_data); ?>;
</script>
    <script src="script.js"></script>
</body>
</html>
