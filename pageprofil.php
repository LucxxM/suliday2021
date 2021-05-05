<?php require 'inc/header.php'; ?>


<?php

if (!empty($_SESSION)) {
    $user_id = $_SESSION['id'];

    $sqlUser = "SELECT * FROM users WHERE id = '{$user_id}'";

    $resultUser = $connect->query($sqlUser);

    if ($user = $resultUser->fetch(PDO::FETCH_ASSOC)) {
?>

        <section class="is-flex is-justify-content-center is-align-content-center">
        
            <div class="box has-text-centered column is-half mt-6">
                <div class="field">
                    <h3 class="label">Bienvenue : <?php echo $user['username']; ?>
                    </h3>
                    <p class="mt-6">Vous possédez le role : <?php echo $user['role']; ?></p>
                    <p class="mt-6">Votre email pour ce compte : <?php echo $user['email']; ?></p>
                </div>
                <div class="mt-6">
                    <a href="biensuser.php" class="button button is-dark" >
                        Voir mes articles publiés
                    </a>
                    <a href="addbien.php" class="button"> Ajouter un article </a>
                </div>
                <div class="mt-4">
                    <a class="button is-danger" href="supprimer.php?id=<?php echo $user['id'] ?>">Se desinscrire</a>
                    <?php
                    if ($user['role'] === 'ROLE ADMIN') {
                        echo '<a href="pageadmin.php" class="button"> Accéder à l\'espace administrateur </a>';
                    }
                    
                    ?>
                </div>
            </div>
        </section>
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
        OverlayScrollbars(document.querySelectorAll("body"), { });
        });
        </script>  
  </body>
</html>