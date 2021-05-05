<?php require 'inc/header.php'; ?>


<?php


$id = $_GET['id'];




$sqlProduct = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id WHERE p.products_id = {$id} ";

$product = $connect->query($sqlProduct)->fetch(PDO::FETCH_ASSOC);
?>

<?php



$sqlCategory = 'SELECT * FROM categories';


$categories = $connect->query($sqlCategory)->fetchAll();


if (isset($_POST['product_submit']) && !empty($_POST['product_name']) && !empty($_POST['product_price']) && !empty($_POST['product_description']) && !empty($_POST['product_category'])) {


    $name = strip_tags($_POST['product_name']);
    $description = strip_tags($_POST['product_description']);
    $price = intval(strip_tags($_POST['product_price']));
    $category = strip_tags($_POST['product_category']);
    $user_id = $_SESSION['id'];


    if (is_int($price) && $price > 0) {
       
        try {
            
            $sth = $connect->prepare("UPDATE products
            SET
            products_name=:products_name,products_description=:products_description,products_price=:products_price, category=:category WHERE products_id = :id");
            
            $sth->bindValue(':products_name', $name);
            $sth->bindValue(':products_description', $description);
            $sth->bindValue(':products_price', $price);
            $sth->bindValue(':category', $category);
            $sth->bindValue(':id', $id);

            
            $sth->execute();

            echo "Votre article a bien été modifié";

            header('Location: pagebien.php?id=' . $id);
        } catch (PDOException $error) {
            echo 'Erreur: ' . $error->getMessage();
        }
    }

}
?>

<main class="is-flex is-justify-content-center is-align-content-center">
    <div class="box has-text-centered column">
        <div class="is-flex is-justify-content-center is-align-content-center">
            <form class="box has-text-centered column is-half" action="#" method="POST">
                <div class="field">
                    <label class="label" for="InputName">Nom de l'article</label>
                    <input class="input has-text-centered" type="text" class="form-control" id="InputName" placeholder="Nom de votre article" name="product_name" value=<?php echo $product['products_name']; ?> required>
                </div>
                <div class="form-group">
                    <label class="label" for="InputDescription">Description de l'article</label>
                    <textarea class="textarea has-text-centered" id="InputDescription" rows="3" name="product_description" required><?php echo $product['products_description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label class="label" for="InputPrice">Prix de l'article</label>
                    <input class="input has-text-centered" type="number" min="1" max="999999" class="form-control" id="InputPrice" placeholder="Prix de votre article en €" name="product_price" value=<?php echo $product['products_price']; ?> required>
                </div>
                <div class="form-group">
                    <label class="label" for="InputCategory">Catégorie de l'article</label>
                    <select class="form-control" id="InputCategory" name="product_category" required>
                        <option value="<?php echo $product['category']; ?>"><?php echo $product['categories_name']; ?></option>
                        <?php
                        
                        foreach ($categories as $category) {
                        ?>
                            <option value="<?php echo $category['categories_id']; ?>">
                                <?php echo $category['categories_name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <hr>
                <button type="submit" class="button is-dark" name="product_submit">Enregistrer l'article</button>
            </form>
        </div>
    </div>
</main>