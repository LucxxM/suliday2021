<?php require 'inc/header.php'; ?>

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
              //? Je veux afficher tous mes produits, selon le même modèle, donc je fais une boucle, et j'insère les données dynamiques dans une carte sur laquelle je ferais une boucle. Résultat: J'obtiens autant de cartes que de produits, et toutes les cartes respectent le même format HTML.
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
                      <a class="button is-danger">Supprimer</a>
                      <a class="button is-dark">Editer</a>
                      
                  </div>
                  </div>
              </div>
              </div>
            <?php
            } 
            ?>
          </section>


    

<?php
//! Affichage de tous les produits. Il faudra une requête SQL qui récupère tous les produits, et qui les affiche dans des cartes séparées.

//? Création de ma requête SQL. Vu que j'ai des colonne qui font référence à d'autres tables, je dois ajouter des jointures sur category et author.
$sqlProducts = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id ORDER By created_at DESC";

//? Le résultat de ma requête est affiché dans un tableau associatif à l'aide du chaînage de méthodes.
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
        //? Je veux afficher tous mes produits, selon le même modèle, donc je fais une boucle, et j'insère les données dynamiques dans une carte sur laquelle je ferais une boucle. Résultat: J'obtiens autant de cartes que de produits, et toutes les cartes respectent le même format HTML.
        foreach ($products as $product) {
        ?>
        <div class="column is-4">
          <div class="card is-shady">
            <div class="card-image">
              <figure class="image is-4by3">
                <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1267&q=80" alt="Placeholder image">
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
                <a class="button is-danger">Supprimer</a>
                <a class="button is-dark">Editer</a>
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
    //The first argument are the elements to which the plugin shall be initialized
    //The second argument has to be at least a empty object or a object with your desired options
    OverlayScrollbars(document.querySelectorAll("body"), { });
    });
    </script>  
  </body>
 
</html>


    <script src="https://unpkg.com/bulma-modal-fx/dist/js/modal-fx.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.9.1/js/OverlayScrollbars.min.js'></script>  
    <script src="../js/wild.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    //The first argument are the elements to which the plugin shall be initialized
    //The second argument has to be at least a empty object or a object with your desired options
    OverlayScrollbars(document.querySelectorAll("body"), { });
    });
    </script>  
  </body>
 
</html>