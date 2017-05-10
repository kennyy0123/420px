<?php
    session_start();
    require('class/picture.class.php');
    
    $picture_resolve = "";
    
    if (!isset($_GET['rgb']) || empty($_GET['rgb'])) {
        header('Location: gallerie.php');
    }

    
    $result = new Picture();
    $array_picture = $result->get_allpicture();
    $picture_resolve = $result->get_picturergb($_GET['rgb'], $array_picture);
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
      <a class="nav-item is-tab is-hidden-mobile is-active" href="gallerie.php">Gallerie</a>
      <a class="nav-item is-tab is-hidden-mobile" href="xml.php">RSS</a>
    </div>
   <?php if (isset($_SESSION['pseudo'])) : ?>
        <div class="nav-right nav-menu">
        <a class="nav-item is-tab" href="logout.php">Log out</a>
    </div>
    <?php endif; ?>
  </div>
</nav>

<h1 class="title" id="title_page">Image Color with RGB(<?php echo $_GET['rgb'] ?>)</h1>
<hr style="background-color: rgb(<?php echo $_GET['rgb'] ?>); margin: 0 auto; width: 400px;">
<div class="columns is desktop">
<div class="column">
<div class="columns is-multiline is-mobile" style="padding-top: 50px;">
<?
    for ($x = 0; $x <= count($picture_resolve) - 1; $x++) {
      $result_cut = explode("picture/", $picture_resolve[$x]);
      echo "<div class='column is-one-quarter'><form method="."POST".">
            <div class='card'>
          <header class='card-header'>
          </header>
          <div class='card-content'>
            <a href='filtre.php?picture=$picture_resolve[$x]'><img src='$picture_resolve[$x]'></a>
          </div>
          <footer class='card-footer'>
             <button href='$picture_resolve[$x]' class='card-footer-item' style='background: white; border:none;' name='delete' type='submit'>
             <input name='url' value='$picture_resolve[$x]' type='hidden'></input>
              Supprimer
          </button>
          </footer>
        </div></form></div>";
    }
  ?>
</div>
</body>
</html>