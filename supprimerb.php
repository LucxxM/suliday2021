<?php require 'inc/header.php'; ?>
<?php
$user_id= $_SESSION['id'];

if(!empty($user_id)){
    
    $sqlUser = "SELECT * FROM users WHERE id = '{$user_id}'";

    $resultUser = $connect->query($sqlUser);

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

