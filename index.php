<?php
    require_once('class/user.class.php');
    
    session_start();
     $res = null;

     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $result = new User();
         $res = $result->connect_user($_POST['pseudo'], $_POST['password']);
     }

     if (empty($_SESSION)) {
        header('Location: connexion.php');
     }
?>

<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>420 PX</title>
  <link rel="stylesheet" href="css/bulma.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="nav has-shadow">
  <div class="container">
    <div class="nav-left">
      <a class="nav-item">
        <h1> 420 PX </h1>
      </a>
       <?php if (empty($_SESSION['pseudo'])): ?>
        <a class="nav-item is-tab is-hidden-mobile" href="connexion.php">Connexion</a>
        <a class="nav-item is-tab is-hidden-mobile" href="register.php">Inscription</a>
      <?php endif; ?>
      <a class="nav-item is-tab is-hidden-mobile" href="gallerie.php">Gallerie</a>
      <a class="nav-item is-tab is-hidden-mobile" href="xml.php">XML</a>
    </div>

    <?php if (isset($_SESSION['pseudo'])) : ?>
        <div class="nav-right nav-menu">
        <a class="nav-item is-tab" href="logout.php">Log out</a>
    </div>
    <?php endif; ?>
  </div>
</nav>
</body>
</html>