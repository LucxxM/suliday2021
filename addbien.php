<?php require 'inc/header.php'; ?>


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
            
            $sth = $connect->prepare("INSERT INTO products
            (products_name,products_description,products_price, author, category)
            VALUES
            (:products_name,:products_description,:products_price, :author, :category)");
            
            $sth->bindValue(':products_name', $name);
            $sth->bindValue(':products_description', $description);
            $sth->bindValue(':products_price', $price);
            $sth->bindValue(':author', $user_id);
            $sth->bindValue(':category', $category);

            $sth->execute();

            echo "Votre article a bien été ajouté";

            header('Location: pagebiens.php');
        } catch (PDOException $error) {
            echo 'Erreur: ' . $error->getMessage();
        }
    }
    

?>
<section class="is-flex is-justify-content-center is-align-content-center">
    <div class="box has-text-centered column is-half">
        <form class=" box has-text-centered" action="#" method="POST">
            <div class="field">
                <label class="label" for="InputName">Nom de l'article</label>
                <input type="text" class="input has-text-centered" id="InputName" placeholder="Nom de votre article" name="product_name" required>
            </div>
            <div class="field">
                <label class="label"for="InputDescription">Description de l'article</label>
                <textarea class="textarea has-text-centered" id="InputDescription" placeholder="Entrez la description du bien" rows="9" cols="9" name="product_description" required></textarea>
            </div>
            <div class="field">
                <label class="label"for="InputPrice">Prix de l'article</label>
                <input type="number" min="1" max="1999999" class="input has-text-centered" id="InputPrice" placeholder="Prix de votre article en €" name="product_price" required>
            </div>
            <div class="field">
                <label class="label"for="InputCategory">Catégorie de l'article</label>
                <select class="form-control" id="InputCategory" name="product_category" required>
                <option selected>Selectionnez le categorie </option>
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
</section>
<?php 

}else {
    echo "<div class='is-flex is-justify-content-center is-align-content-center has-background-danger'><p>Impossible de poster une annonce lorsque vous êtes hors-ligne</p></div>";
}

?>
</body>
</html>