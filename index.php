<?php 
session_start();
require_once("connexion/user.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    Hello world ! 
    <?php 
	if (!isset($_SESSION['User']))
        echo '<a href="connexion/connexion.php">Connectez vous</a>';
    else
        echo '<a href="connexion/logout.php">Déconnectez vous</a>';
?>

</body>
</html>