<?php require 'inc/header.php'; ?>


<?php

// ! Pour faire une requête de mise à jour (UPDATE), je vais mélanger affichage d'un seul produit, avec l'ajout d'un produit en modifiant légèrement ma requête SQL

//? J'insère la valeur de l'id de ma requête GET dans une variable qui va me servir à récupérer un produit depuis la BDD, mais aussi à le mettre à jour dans la BDD
$id = $_GET['id'];

// var_dump($_POST, $id);

//? REQUETE D'AFFICHAGE = Création de ma requête SQL. Vu que j'ai des colonnes qui font référence à d'autres tables, je dois ajouter des jointures sur category et author. Je rajoute aussi la condition WHERE users_id = {$id} afin de récupérer le produit souhaité
$sqlUser = "SELECT * FROM users WHERE id = {$id}";

//? Le résultat de ma requête est affiché dans un tableau associatif à l'aide du chaînage de méthodes.
$user = $connect->query($sqlUser)->fetch(PDO::FETCH_ASSOC);
?>

<?php

// var_dump($categories);

/**
 * ! Modifier un article à partir du formulaire.
 * 
 * TODO : Récupération des données depuis la BDD
 * 
 * TODO : Vérification intro : si le bouton est cliqué et si le formulaire est rempli
 * 
 * TODO : Initialisation des variables & assainissement
 * 
 * TODO : Vérification du prix positif
 * 
 * TODO : Modification des données
 */

//? Etape 1 : Vérification de la validité du formulaire et de l'appui sur le bouton envoi
if (isset($_POST['user_submit']) && !empty($_POST['username']) && !empty($_POST['role'])) {

    //? Etape 2 : Initialisation des variables & assainissement (via strip_tags cette fois)

    $username = strip_tags($_POST['username']);
    $role = strip_tags($_POST['role']);

        //? Etape 4 : Enregistrement des données du formulaire via une requete préparée sql UPDATE
        try {
            //? Préparation de la requête, je définis la requête à exécuter avec des valeurs génériques (des paramètres nommés).
            //! Attention, les requêtes INSERT et UPDATE sont sensiblement différentes sur leur syntaxe
            $sth = $connect->prepare("UPDATE users
            SET
            username=:users_name, role=:users_role WHERE id = :id");
            //? J'affecte chacun des paramètres nommés à leur valeur via un bindValue. Cette opération me protège des injections SQL (en + de l'assainissement des variables).
            $sth->bindValue(':users_name', $username);
            $sth->bindValue(':users_role', $role);
            $sth->bindValue(':id', $id);

            //? J'exécute ma requête SQL de modification avec execute()
            $sth->execute();

            echo "Le profil a bien été modifié";

            //? Je redirige vers la page des produits.
            header('Location: pageadmin.php');
        } catch (PDOException $error) {
            echo 'Erreur: ' . $error->getMessage();
        }
    // var_dump($name, $description, $price, $category);
}
?>

<main class="is-flex is-justify-content-center is-align-content-center">
    <div class="box has-text-centered column">
        <div>
            <form class="box has-text-centered column is-half" action="#" method="POST">
                <div class="field">
                    <label class="label" for="InputName">Nom</label>
                    <input class="input has-text-centered" type="text" class="form-control" id="InputName" placeholder="Nom de votre article" name="username" value="<?php echo $user['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label class="label" for="InputCategory">role</label>
                    <select class="form-control" id="InputCategory" name="role" required>
                        <?php
                          if($user['role'] === 'ROLE_ADMIN'){
                        ?>
                            <option value="ROLE_ADMIN" selected>Admin</option>
                            <option value="ROLE_USER">User</option>
                        <?php
                          }else{
                        ?>
                            <option value="ROLE_ADMIN">Admin</option>
                            <option value="ROLE_USER" selected>User</option>
                        <?php
                          }
                        ?>
                    </select>
                </div>
                <hr>
                <button type="submit" class="button is-dark" name="user_submit">Actualiser l'utilisateur</button>
            </form>
        </div>
    </div>
</main>