<?php
    require_once('connexion/user.php');
    session_start();
    $ville = $_GET['ville'];
?>
<link rel="stylesheet" href="header.css">
<header>
    <a href="index.php" class="back-button"><i class="fas fa-home"></i></a>
    <div class="language-select">
    <a  href="?ville=<?php echo $ville ?>&lang=fr"><img class='language-icon' src="img/fr.png" alt="Français"></a>
    <a  href="?ville=<?php echo $ville ?>&lang=en"><img class='language-icon' src="img/en.jpg" alt="English"></a>
</div>
    <h4>Monuments de France</h4>
    <div class="buttons">
        <?php
           if (!empty($_SESSION['User'])) {
            $user = $_SESSION['User'];
            echo '<a href="connexion/logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i></a>';
        } else {
            echo '<a href="connexion/connexion.html" class="login-button"><i class="fas fa-sign-in-alt"></i></a>';
        }
        ?>
    </div>
</header>
