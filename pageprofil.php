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
?>

        <main class="is-flex is-justify-content-center is-align-content-center">
            <div class="box has-text-centered column is-half">
                <div class="field">
                    <!-- //* Affichage des infos username et role récupérées depuis la BDD -->
                    <h3>Bienvenue <?php echo $user['username']; ?>
                    </h3>
                    <p>Vous possédez le role <?php echo $user['role']; ?></p>
                </div>
                <div class="field">
                    <a href="biensuser.php" class="button button is-dark" >
                        Voir mes articles publiészzz
                    </a>
                    <a href="addbien.php" class="button"> Ajouter un article </a>
                    <?php
                    if ($user['role'] === 'ROLE ADMIN') {
                        echo '<a href="pageadmin.php" class="button"> Accéder à l\'espace administrateur </a>';
                    }
                    
                    ?>
                </div>
            </div>
        </main>
    <?php
    } else {
        echo " Erreur de connexion, veuillez vous reconnecter";
        session_destroy();
    }
} else {
    ?>
    <main>
        <p class="lead">Vous ne pouvez pas accéder à votre profil sans vous connecter</p>
        <p class="lead">
            <a href="pageconnexion.php" class="button">Se connecter</a>
        </p>
    </main>
<?php
}
?>
   
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