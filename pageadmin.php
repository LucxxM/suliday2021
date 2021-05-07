<?php require 'inc/header.php'; ?>
<div class="is-flex is-justify-content-center is-align-content-center"><a class="button is-dark mt-4" href="addcategory.php">Ajouter une catégorie</a></div>
<?php
if (!empty($_SESSION)) {
    //? 1. On insère l'id de session dans une variable qui va servir pour une requête SQL si il y a un utilisateur connecté
    $user_id = $_SESSION['id'];

    //? 2. On réalise une requête SQL de récupération de données (SELECT) qui utilise l'id de l'utilisateur connecté pour récupérer toutes sa ligne dans la BDD
    $sqlAdmin = "SELECT * FROM users WHERE id = '{$user_id}'";
    $sqlUser = "SELECT * FROM users WHERE role != 'ROLE ADMIN' ";

    //? 3. On effectue la requête via PDO sur la base de données.
    $resultAdmin = $connect->query($sqlAdmin);
    $resultUser = $connect->query($sqlUser);
    $users = $resultUser->fetchAll(PDO::FETCH_ASSOC);

    //? 4. On récupère les données avec un fetch, en précisant que l'on souhaite obtenir les données sous forme de tableau associatif (PDO::FETCH_ASSOC)
    if ($admin = $resultAdmin->fetch(PDO::FETCH_ASSOC)) {
        // $user = $connect->query($sql)->fetch(PDO::FETCH_ASSOC);


        if ($admin['role'] === 'ROLE USER') {
            echo '<div class="is-flex is-justify-content-center is-align-content-center"><a href="index.php" class="button is-danger mt-6"> Vous ne pouvez pas accèder à cette page</a></div>';
        }
        
        else { ?>
          <section class="hero is-dark is-small mt-4">
              <div class="hero-body">
                <div class="container has-text-centered">
                <p class="title">
                    USERS
                </p>
                </div>
              </div>
          </section>
          <section class="is-flex is-flex-wrap-wrap">
              <?php
              foreach ($users as $user) {
              ?>
              <div class="column is-4">
              <div class="card is-shady">
                  <div class="card-image">
                  </div>
                  <div class="card-content">
                  <div class="content">
                      <h4><?php echo $user['username'];?></h4>
                      <p><?php echo $user['email']; ?></p>
                      <p><?php echo $user['role']; ?></p>
                      <a class="button is-danger" href="supprimer.php?id=<?php echo $user['id'] ?>">Supprimer</a>
                      <a href="editadminu.php?id=<?php echo $user['id'] ?>" class="button is-dark">Editer</a>
                      
                  </div>
                  </div>
              </div>
              </div>
            <?php
            } 
            ?>
          </section>


    

<?php

$sqlProducts = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id ORDER By created_at DESC";

$products = $connect->query($sqlProducts)->fetchAll(PDO::FETCH_ASSOC);
?>

    <section class="hero is-dark is-small mt-6">
      <div class="hero-body">
        <div class="container has-text-centered">
          <p class="title">
            ANNONCES
          </p>
        </div>
      </div>
    </section>

    
    <section class="is-flex is-flex-wrap-wrap">
        <?php
        foreach ($products as $product) {
        ?>
        <div class="column is-4">
          <div class="card is-shady">
            <div class="card-image">
              <figure class="image">
              
                <?php if (is_null($product['image']) || empty($product['image'])) {
                    echo "<img src='./public/uploads/noImg.png' alt='product_image' width='400'/> ";
                } else {
                ?>
                    <img src="./public/uploads/<?php echo $product['image']; ?>" alt='<?php echo $product['products_name']; ?>' width='200' />
                <?php
                }
                ?>
            
              </figure>
            </div>
            <div class="card-content">
              <div class="content">
                <h4><?php echo $product['products_name'];?></h4>
                <p><?php echo $product['products_description']; ?></p>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><?php echo $product['products_price']; ?>€</li>
                </ul>
                <p><?php echo $product['categories_name']; ?></p>
                <p><?php echo $product['created_at']; ?></p>
                <p>Vendu par : <?php echo $product['username']; ?></p>
                <a class="button is-danger" href="supprimerb.php?id=<?php echo $product['products_id'] ?>">Supprimer</a>
                <a href="./editadminb.php?id=<?php echo $product['products_id'] ?>" class="button is-dark">Editer</a>
              </div>
            </div>
          </div>
        </div>
        <?php
        }
      }
    }
  }
        ?>

        
    </section>
    <script src="https://unpkg.com/bulma-modal-fx/dist/js/modal-fx.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.9.1/js/OverlayScrollbars.min.js'></script>  
    <script src="../js/wild.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    OverlayScrollbars(document.querySelectorAll("body"), { });
    });
    </script>  
  </body>
 
</html>

