<?php require 'inc/header.php'; ?>
<?php
$user_id= $_SESSION['id'];

if(!empty($user_id)){
    
    $sqlUser = "SELECT * FROM users WHERE id = '{$user_id}'";

    //? 3. On effectue la requête via PDO sur la base de données.
    $resultUser = $connect->query($sqlUser);

    //? 4. On récupère les données avec un fetch, en précisant que l'on souhaite obtenir les données sous forme de tableau associatif (PDO::FETCH_ASSOC)
    if ($user = $resultUser->fetch(PDO::FETCH_ASSOC)) {
        if($user['role']==='ROLE ADMIN'){

            $pdostats = $connect->prepare('DELETE FROM products WHERE products_id =:num LIMIT 1');
            
            $pdostats->bindvalue(':num', $_GET['id'], PDO::PARAM_INT);
            
            $executeIsOk = $pdostats->execute();
            
            if($executeIsOk) {
            
                echo '<p>le bien été supprimé</p>';
            }
            else {
                echo '<p>echec de la suppression</p>';
            }
        } elseif($user['role']==='ROLE USER'){
            $pdostats = $connect->prepare('DELETE FROM products WHERE products_id =:num AND author=:id LIMIT 1');
            
            $pdostats->bindvalue(':num', $_GET['id'], PDO::PARAM_INT);
            $pdostats->bindvalue(':id', $user_id, PDO::PARAM_INT);
            
            $executeIsOk = $pdostats->execute();
            
            if($executeIsOk) {
            
                echo '<p>le bien été supprimé</p>';
            }
            else {
                echo '<p>echec de la suppression</p>';
            }

        }
    }
}

