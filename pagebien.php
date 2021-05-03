<?php require 'inc/header.php'; ?>

<!-- //! Affichage d'un produit en détails -->
<?php

//? J'insère la valeur de l'id de ma requête GET dans une variable qui va me servir à récupérer un produit depuis la BDD
$id = $_GET['id'];

//? Création de ma requête SQL. Vu que j'ai des colonnes qui font référence à d'autres tables, je dois ajouter des jointures sur category et author. Je rajoute aussi la condition WHERE products_id = {$id} afin de récupérer le produit souhaité
$sqlProduct = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id WHERE p.products_id = {$id} ";

//? Le résultat de ma requête est affiché dans un tableau associatif à l'aide du chaînage de méthodes.
$product = $connect->query($sqlProduct)->fetch(PDO::FETCH_ASSOC);
?>
<!-- //? Ici pas besoin de boucle, puisque je ne récupère qu'un seul produit. -->
<main class="is-flex is-justify-content-center is-align-content-center">
    <div class="box has-text-centered column is-half">
        <div class="col-12">
            <figure class="image is-4by3">
                <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1267&q=80" alt="Placeholder image">
            </figure>
            <h1><?php echo $product['products_name']; ?>
            </h1>
            <p>Catégorie : <?php echo $product['categories_name']; ?>
            </p>
            <p><?php echo $product['products_description']; ?>
            </p>
            <p>Vendu par : <?php echo $product['username']; ?>
            </p>
            <p>Annonce publiée le : <?php echo $product['created_at']; ?>
            </p>
            <button class="button"><?php echo $product['products_price']; ?> € </button>
        </div>
    </div>
</main>