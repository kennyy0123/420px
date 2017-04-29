<?php
  session_start();

  if( isset($_POST['upload'])) 
  {
    $content_dir = 'picture/'; 
    $tmp_file = $_FILES['fichier']['tmp_name'];

    if(!is_uploaded_file($tmp_file) )
        exit("Le fichier n'existe pas");

    $type_file = $_FILES['fichier']['type'];
    $name_file = $_FILES['fichier']['name'];

    if(!move_uploaded_file($tmp_file, $content_dir . $name_file) )
        exit("Le fichier est impossible à créer : $content_dir");
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
    </div>
    <?php if (isset($_SESSION['pseudo'])) : ?>
        <div class="nav-right nav-menu">
        <a class="nav-item is-tab" href="logout.php">Log out</a>
    </div>
    <?php endif; ?>
  </div>
</nav>
<?php if (isset($_SESSION['pseudo'])) : ?>

  <form method="post" enctype="multipart/form-data">
  <div id="upload_picture">
    <input type="file" class="custom-file-upload" name="fichier" size="30" accept="image/x-png,image/gif,image/jpeg">
    <input class="button is-small" type="submit" name="upload" value="Uploader">
  </div>
  </form>
<?php endif; ?>
</div>

</body>
</html>