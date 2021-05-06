<?php require 'inc/header.php'; ?>

<?php
if (!empty($_SESSION)) {
    $user_id = $_SESSION['id'];
    $sqlCategory = 'SELECT * FROM categories';
    $categories = $connect->query($sqlCategory)->fetchAll();

    

    if (isset($_POST['product_submit']) && !empty($_POST['categories_name'])) {

    

        $name = strip_tags($_POST['categories_name']);
        
        $user_id = $_SESSION['id'];

        
        
            
            try {
                
                $sth = $connect->prepare("INSERT INTO categories
                (categories_name)
                VALUES
                (:categories_name)");
                
                $sth->bindValue(':categories_name', $name);
                

                $sth->execute();

                

                // header('Location: pagebiens.php');
                echo "la categorie a bien été ajouté";
            } catch (PDOException $error) {
                echo 'Erreur: ' . $error->getMessage();
            }
        
        
    }
    ?>
    <section class="is-flex is-justify-content-center is-align-content-center">
        <div class="box has-text-centered column is-half">
            <form class=" box has-text-centered" action="#" method="POST">
                <div class="field">
                    <label class="label" for="InputName">Categorie à ajouter</label>
                    <input type="text" class="input has-text-centered" id="InputName" placeholder="Nom de votre article" name="categories_name" required>
                </div>
                <button type="submit" class="button is-dark" name="product_submit">Enregistrer la catégorie</button>
            </form>
        </div>
    </section>
    
<?php
}
?>

</body>
</html>