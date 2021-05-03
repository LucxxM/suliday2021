<?php require 'inc/header.php'; ?>


<?php
//! Récupérer toutes les infos relatives à l'utilisateur connecté depuis la base de données. En ce moment dans le token de session on possède l'id de l'utilisateur, son username et son email. Il faut éventuellement récupérer tout le reste depuis la base de données.

if (!empty($_SESSION)) {
    //? 1. On insère l'id de session dans une variable qui va servir pour une requête SQL si il y a un utilisateur connecté
    $user_id = $_SESSION['id'];

    //? 2. On réalise une requête SQL de récupération de données (SELECT) qui utilise l'id de l'utilisateur connecté pour récupérer toutes sa ligne dans la BDD
    $sqlUser = "SELECT * FROM users WHERE id = '{$user_id}'";

    //? 3. On effectue la requête via PDO sur la base de données.
    $resultUser = $connect->query($sqlUser);

    //? 4. On récupère les données avec un fetch, en précisant que l'on souhaite obtenir les données sous forme de tableau associatif (PDO::FETCH_ASSOC)
    if ($user = $resultUser->fetch(PDO::FETCH_ASSOC)) {
        // $user = $connect->query($sql)->fetch(PDO::FETCH_ASSOC);

        $sqlProducts = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id WHERE author = {$user_id} ORDER By created_at DESC";

//? Le résultat de ma requête est affiché dans un tableau associatif à l'aide du chaînage de méthodes.
$products = $connect->query($sqlProducts)->fetchAll(PDO::FETCH_ASSOC);
// var_dump($products);
?>

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
                <a class="button is-dark modal-button" href="pagebien.php?id=<?php echo $product['products_id']; ?>" class="card-link btn btn-primary">Afficher article</a>
              </div>
            </div>
          </div>
        </div>
        <?php
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
 <?php } } ?>
</html>