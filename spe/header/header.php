<?php
    require_once('connexion/user.php');

            session_start();
            if (!empty($_SESSION['User'])) {
                $user = $_SESSION['User'];
                echo '    <a href="index.php" class="back-button">Menu</a>';
               // echo '<p>Bienvenue, ' . $user->loginName . '!</p>';
                echo '<a href="connexion/logout.php" class="logout-button">Déconnexion</a>';
            } else {
                echo '<a href="connexion/connexion.html" class="login-button">Connexion</a>';
                header('location:connexion/connexion.html');
            }
        ?>