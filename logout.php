<?php

    session_start();

    if (isset($_SESSION['pseudo'])){
        session_unset($_SESSION['pseudo']); // Unset runtime variable
        session_destroy();  // Destroy session
    }
    
    header('Location: connexion.php');
?>