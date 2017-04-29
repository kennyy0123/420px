<?php
    require_once('user/user.class.php');
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
      <a class="nav-item is-tab is-hidden-mobile is-active" href="index.php">Connexion</a>
      <a class="nav-item is-tab is-hidden-mobile" href="register.php">Inscription</a>
      <a class="nav-item is-tab is-hidden-mobile" href="gallerie.php">Gallerie</a>
    </div>
    <div class="nav-right nav-menu">
      <a class="nav-item is-tab">Log out</a>
    </div>
  </div>
</nav>
  <div class="columns is-desktop" id="box_signIn">
  <div class="column is-6">
    <div class="field">
  <p class="control has-icons-left">
    <input class="input" type="email" placeholder="Email">
    <span class="icon is-small is-left">
      <i class="fa fa-envelope"></i>
    </span>
  </p>
</div>
<div class="field">
  <p class="control has-icons-left">
    <input class="input" type="password" placeholder="Mot de passe">
    <span class="icon is-small is-left">
      <i class="fa fa-lock"></i>
    </span>
  </p>
</div>
<div class="field">
  <p class="control">
    <a class="button is-primary is-focused" id="button_login">Se connecter</a>
  </p>
</div>
  </div>
</div>
</body>
</html>