
<?php require 'inc/config.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="assets/css/style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
  <title>Document</title>
</head>
<body>
<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a href="">
      <img src="./assets/images/logo-immobilier-4.png" width="100" height="100">
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu ml-6">
    <div class="navbar-end">
      <a class="navbar-item ml-6" href="http://localhost/stuliday2021/">
        Accueil
      </a>

      <a class="navbar-item" href="./pagebiens.php">
        Annonces
      </a>
      <?php if (!empty($_SESSION['username'])){
        ?>
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Vous
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="./pageprofil.php">
            Profil
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a href="addbien.php" class="navbar-item">
            Créer une annonce
          </a>
        </div>
        <?php } ?>
      </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
        <?php if (empty($_SESSION['username'])){ ?>
          <a class="button is-warning" href="./pageinscription.php">
            <strong>Sign in</strong>
          </a>
          <a class="button is-light" href="./pageconnexion.php">
            Log in
          </a>
            <?php } else{?>
              <a class="button is-warning" href="?logout">
            <strong>Logout</strong>
          </a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</nav>