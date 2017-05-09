<?php
    session_start();
    require('class/filter.class.php');
    
    $path = "";
    $filtre = new filter();

    if (isset($_GET["picture"])) {
        $path = $_GET["picture"];
    }

    if (isset($_POST["contraste-plus"])) {
      $filtre->filter_function($path, "contraste-plus");
    }
    else if (isset($_POST["contraste-minus"])) {
      $filtre->filter_function($path, "contraste-minus");
    }
     else if (isset($_POST["gauss"])) {
      $filtre->filter_function($path, "gauss");
      echo "gauss";
    }
    else if (isset($_POST["sepia"])) {
      $filtre->filter_function($path, "sepia");
    }
     else if (isset($_POST["gray"])) {
      $filtre->filter_function($path, "gray");
    }
    else if (isset($_POST["contour"])) {
      $filtre->filter_function($path, "contour");
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

<h1 class="title" id="title_page">Picture Filter</h1>

<form method="post">
<div style="width: 100%; text-align:center;">
    <button class="button is-outlined" name="contraste-plus"  type="submit">Contraste +</button>
    <button class="button is-outlined" name="contraste-minus"  type="submit">Contraste -</button>
    <!--<button class="button is-outlined" name="luminosite+" type="submit">Luminosité +</button>
    <button class="button is-outlined" name="luminosite-" type="submit">Luminosité -</button>-->
    <button class="button is-outlined" name="gauss" type="submit">Gauss</button>
    <button class="button is-outlined" name="sepia" type="submit">Sépia</button>
    <button class="button is-outlined" name="gray" type="submit">Gris</button>
    <button class="button is-outlined" name="contour" type="submit">Contour</button>
</div>
</form>

<div class="box" style="width: 35%; margin: 0 auto;">
    <img href=></img>
    <?php if ($_GET['picture']) : ?>
    <?
          $result = $_GET["picture"];
          echo "<img src='$result' style='width: 100%;'/>";
    ?>
    <?php endif; ?>
</div>

</div>
</body>
</html>