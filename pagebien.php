<?php require 'inc/header.php'; ?>

<?php

$id = $_GET['id'];

$sqlProduct = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id WHERE p.products_id = {$id} ";

$product = $connect->query($sqlProduct)->fetch(PDO::FETCH_ASSOC);
?>
<section class="is-flex is-justify-content-center is-align-content-center">
    <div class="box has-text-centered column is-half">
        <div class="col-12">
            <figure class="image is-4by3">
                <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1267&q=80" alt="Placeholder image">
            </figure>
            <h1 class="label"><?php echo $product['products_name']; ?>
            </h1>
            <p>Catégorie : <?php echo $product['categories_name']; ?>
            </p>
            <p><?php echo $product['products_description']; ?>
            </p>
            <p>Vendu par : <?php echo $product['username']; ?>
            </p>
            <p>Annonce publiée le : <?php echo $product['created_at']; ?>
            </p>
            <div class="label"><?php echo $product['products_price']; ?> € </div>
        </div>
    </div>
</section>