<?php require 'inc/header.php'; ?>


<?php


if (!empty($_SESSION)) {

    $user_id = $_SESSION['id'];


    $sqlUser = "SELECT * FROM users WHERE id = '{$user_id}'";

  
    $resultUser = $connect->query($sqlUser);

    
    if ($user = $resultUser->fetch(PDO::FETCH_ASSOC)) {

        $sqlProducts = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id WHERE author = {$user_id} ORDER By created_at DESC";


$products = $connect->query($sqlProducts)->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="is-flex is-flex-wrap-wrap">
        <?php
       
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
                
                <p class="list-group-item"><?php echo $product['products_price']; ?>€</p>
                
                <p><?php echo $product['categories_name']; ?></p>
                <p><?php echo $product['created_at']; ?></p>
                <a class="button is-dark modal-button" href="pagebien.php?id=<?php echo $product['products_id']; ?>" class="card-link btn btn-primary">Afficher article</a>
                <a class="button is-danger" href="supprimerb.php?id=<?php echo $product['products_id'] ?>">Supprimer</a>
                <a href="./editadminb.php?id=<?php echo $product['products_id'] ?>" class="button is-warning">Editer</a>
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

    OverlayScrollbars(document.querySelectorAll("body"), { });
    });
    </script>  
  </body>
 <?php } } ?>
</html>