<?php $page = 'bien'; ?>
<?php require 'inc/header.php'; ?>

<?php

$sqlProducts = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id ORDER By created_at DESC";

$products = $connect->query($sqlProducts)->fetchAll(PDO::FETCH_ASSOC);
?>

    <section class="hero is-dark is-small">
      <div class="hero-body">
        <div class="container has-text-centered">
          <p class="title">
            ANNONCES
          </p>
          <p class="subtitle">
            faites votre choix
          </p>
        </div>
      </div>
    </section>
    <?php if(!empty($_SESSION['id'])){
    ?>
      <div class="box has-background-warning mt-5">
        <p class="has-text-centered">
          <a href="addbien.php" class="tag is-dark">Créer</a> Vos nouvelles annonces!!
        </p>
      </div>
    <?php
    }
    ?>

    <?php
    $sql = 'SELECT * FROM categories';
    $res = $connect->query($sql);
    $categories = $res->fetchAll();

    if (isset($_POST['search_form'])) {
    $category = intval(strip_tags($_POST['product_category']));
    $search_text = strip_tags($_POST['search_text']);

    $sql2 = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id  WHERE category LIKE '%{$category}%' AND products_name LIKE '%{$search_text}%' ORDER By created_at DESC";
    $res2 = $connect->query($sql2);
    $search = $res2->fetchAll();
    }

    ?>

    <form action="#" method="post">
    <div class="box">
        <div class="is-flex is-flex-direction-column">
            <!-- <label for="InputCategory">Rechercher par nom</label> -->
            <input type="text" name="search_text" id="InputText" placeholder="Rechercher par nom"
                class="input">
        
            <select class="input mt-4" id="InputCategory" name="product_category">
                <option value="" selected> -- Filtrer par catégorie -- </option>
                <?php foreach ($categories as $category) { ?>
                <option
                    value="<?php echo $category['categories_id']; ?>">
                    <?php echo $category['categories_name']; ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <input type="submit" value="Recherche" name="search_form" class="button is-dark mt-4">
        <?php if (isset($search)) {
          echo '<a href="pagebiens.php" class="button is-warning mt-4">Tout afficher</a>';
      } ?>
          </div>
      </form>

    
    <section class="is-flex is-flex-wrap-wrap">

        <?php
        if(isset($search)){
          foreach ($search as $product) {
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
                    <p>Vendu par : <?php echo $product['username']; ?></p>
                    <a class="button is-dark modal-button" href="pagebien.php?id=<?php echo $product['products_id']; ?>">Afficher article</a>
                  </div>
                </div>
              </div>
            </div>
            <?php
            }

        }else{
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
                <p>Vendu par : <?php echo $product['username']; ?></p>
                <a class="button is-dark modal-button" href="pagebien.php?id=<?php echo $product['products_id']; ?>">Afficher article</a>
              </div>
            </div>
          </div>
        </div>
        <?php
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