<?php
  session_start();
  require('user/picture.class.php');
  
  $result = new Picture();
  $res_picture = array();

  if(isset($_POST['upload'])) 
  {
    $content_dir = 'picture/'; 
    $tmp_file = $_FILES['fichier']['tmp_name'];

    if(!is_uploaded_file($tmp_file) )
        exit("Le fichier n'existe pas");

    $type_file = $_FILES['fichier']['type'];
    $name_file = $_FILES['fichier']['name'];
    
    $resul_guid = $result->GUID();

    $image = new Imagick($tmp_file);
    $image->adaptiveResizeImage(420,420);
    $image->writeImage($content_dir . $resul_guid . '.jpg');
    $result_bool = $result->add_picture($content_dir . $resul_guid . '.jpg', $_SESSION['pseudo']);

  }
  
  if (isset($_POST["delete"])) {
    $result->delete_picture($_POST['url']);
    unlink($_POST['url']);
  }

   if (isset($_SESSION['pseudo'])) {
      $res_picture = $result->get_picture($_SESSION['pseudo']);
   }

   if (isset($_POST['search_name'])){
      $res_picture = $result->get_picture($_POST['search_name']);
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
<?php else : ?>
<form method="post">
<div class="field has-addons" style="justify-content: center; margin-top:10px;">
  <p class="control">
    <input class="input" type="text" placeholder="Pseudo"  name="search_name">
  </p>
  <p class="control">
    <button class="button is-info" type="submit">Search</button>
  </p>
</div>
</form>

<?php endif; ?>

<div class="columns is desktop">
<div class="column">
<div class="columns is-multiline is-mobile" style="padding-top: 50px;">
  <?php if (isset($_SESSION['pseudo'])) : ?>
  <?
    for ($x = 0; $x <= count($res_picture) - 1; $x++) {
      echo "<div class='column is-one-quarter'><form method="."POST".">
            <div class='card'>
          <header class='card-header'>
          </header>
          <div class='card-content'>
            <img src='$res_picture[$x]'>
          </div>
          <footer class='card-footer'>
             <button href='$res_picture[$x]' class='card-footer-item' style='background: white; border:none;' name='delete' type='submit'>
             <input name='url' value='$res_picture[$x]' type='hidden'></input>
              supprimer
          </button>
          </footer>
        </div></form></div>";
    }
  ?>
  <?php endif; ?>

  <?php if (empty($_SESSION['pseudo'])) : ?>
  <? 
    for ($x = 0; $x <= count($res_picture) - 1; $x++) {
       $name_res = $res_picture[$x];
      echo "<div class='column is-one-quarter'><div class='card'>
          <header class='card-header'>
          </header>
          <div class='card-content'>
            <img src='$name_res'>
          </div>
        </div></div>";
    } 
  ?>
  <?php endif; ?>

</div>
</div>
</div>
</div>
</body>
</html>