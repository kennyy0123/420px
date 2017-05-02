<?php
    require_once('user/user.class.php');
    session_start();
    
    $res = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $result = new User();
         $res = $result->create_user($_POST['pseudo'], $_POST['password'], $_POST['password_repeat']);
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
          <a class="nav-item is-tab is-hidden-mobile is-active" href="register.php">Inscription</a>
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
 <?php if (isset($res) && $res === false)  : ?>
      <div class="notification is-danger">
        Une erreur est survenue durant la création du compte.
    </div>
 <?php endif; ?>
<?php if (isset($res) && $res === true)  : ?>
    <div class="notification is-success">
        Votre compte à été crée.
    </div>
<?php endif; ?>

<form method="post">
  <div class="columns is-desktop" id="box_register">
  <div class="column is-6">
<div class="field">
  <p class="control has-icons-left">
    <input class="input" name="pseudo" placeholder="Pseudonyme" >
    <span class="icon is-small is-left">
      <i class="fa fa-envelope"></i>
    </span>
  </p>
</div>
<div class="field">
  <p class="control has-icons-left">
    <input class="input" type="password" name="password" placeholder="Mot de passe" >
    <span class="icon is-small is-left">
      <i class="fa fa-lock"></i>
    </span>
  </p>
</div>
<div class="field">
  <p class="control has-icons-left">
    <input class="input" type="password" name="password_repeat" placeholder="Retaper le mot de passe">
    <span class="icon is-small is-left">
      <i class="fa fa-lock"></i>
    </span>
  </p>
</div>
<div class="field">
  <p class="control">
    <button type="submit" class="button is-primary" id="button_login">S'enregistrer</button>
  </p>
</div>
  </div>
  </form>
</div>
</body>
</html>