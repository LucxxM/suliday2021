<?php require 'inc/header.php'; ?>


<?php


$id = $_GET['id'];




$sqlUser = "SELECT * FROM users WHERE id = {$id}";


$user = $connect->query($sqlUser)->fetch(PDO::FETCH_ASSOC);
?>

<?php


if (isset($_POST['user_submit']) && !empty($_POST['username']) && !empty($_POST['role'])) {

    

    $username = strip_tags($_POST['username']);
    $role = strip_tags($_POST['role']);

        
        try {
            
            $sth = $connect->prepare("UPDATE users
            SET
            username=:users_name, role=:users_role WHERE id = :id");
           
            $sth->bindValue(':users_name', $username);
            $sth->bindValue(':users_role', $role);
            $sth->bindValue(':id', $id);
         

            
            $sth->execute();

            echo "Le profil a bien été modifié";

            header('Location: pageadmin.php');
        } catch (PDOException $error) {
            echo 'Erreur: ' . $error->getMessage();
        }
}
  
?>

<main class="field">
    <div class="box has-text-centered column">
        <div class="is-flex is-justify-content-center is-align-content-center">
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