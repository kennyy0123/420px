<?php
    require_once('class/user.class.php');
    session_start();

    if (isset($_POST['user']) && !empty($_POST['user'])) {
        header('Location: xml_file.php' . '/?usr='  . $_POST['user' ] );
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
      <?php if (empty($_SESSION['pseudo']))  : ?>
          <a class="nav-item is-tab is-hidden-mobile" href="connexion.php">Connexion</a>
          <a class="nav-item is-tab is-hidden-mobile" href="register.php">Inscription</a>
      <?php endif; ?>
      <a class="nav-item is-tab is-hidden-mobile" href="gallerie.php">Gallerie</a>
      <a class="nav-item is-tab is-hidden-mobile is-active" href="xml.php">RSS</a>
    </div>
   <?php if (isset($_SESSION['pseudo'])) : ?>
        <div class="nav-right nav-menu">
        <a class="nav-item is-tab" href="logout.php">Log out</a>
    </div>
    <?php endif; ?>
  </div>
</nav>

<h1 class="title" id="title_page">Flux RSS</h1>

<form method="post">
<div class="field has-addons" id="xml_box">
  <p class="control">
    <input class="input" type="text" name="user" placeholder="Utilisateur">
  </p>
  <p class="control">
    <button class="button is-info" type="submit">
      Rechercher
    </button>
  </p>
</div>
</form>

</div>
</body>
</html>