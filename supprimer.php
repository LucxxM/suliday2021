<?php require 'inc/header.php'; ?>
<?php

$pdostats = $objetPdo->prepare('DELETE FROM users WHERE id =:num LIMIT 1');

$pdostats->bindvalue(':num', $_GET['id'], PDO::PARAM_INT);

$executeIsOk = $pdostats->execute();

if($executeIsOk) {

    echo '<p>l\'utilisateur à bien été supprimé</p>';
}
else {
    echo '<p>echec de la suppression</p>';
}

