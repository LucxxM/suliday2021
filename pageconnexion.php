<?php require 'inc/header.php'; ?>



<?php
$alert = false;

if (!empty($_POST['email_login']) && !empty($_POST['password_login']) && isset($_POST['submit_login'])) {
    $email = htmlspecialchars($_POST['email_login']);
    $password = htmlspecialchars($_POST['password_login']);
    try {
        $sqlMail = "SELECT * FROM users WHERE email = '{$email}'";
        $resultMail = $connect->query($sqlMail);
        $user = $resultMail->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $dbpassword = $user['password'];
            if (password_verify($password, $dbpassword)) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];

                $alert = true;
                $type = 'success';
                $message = "Vous êtes désormais connectés";
                unset($_POST);
                header('Location: pageprofil.php');
            } else {
                $alert = true;
                $type = 'danger';
                $message = "Le mot de passe est erroné";
                unset($_POST);
            }
        } else {
            $alert = true;
            $type = 'warning';
            $message = "Ce compte n'existe pas";
            unset($_POST);
        }
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}


?>

<div class='formulaire'>


    <form class="box is-light"  action="#" method="POST">
    <?php echo $alert ? "<br><div class='has-background-{$type} mb-6'>{$message}</div>" : ''; ?>
      <div class="field">
        <label class="label" for="InputEmail1">Email</label>
        <div class="control">
          <input class="input" type="email" id="InputEmail1" placeholder="cestpasmoi@gmail.com" aria-describedby="emailHelp" name="email_login" required>
        </div>
      </div>
    
      <div class="field">
        <label class="label" for="InputPassword1">Password</label>
        <div class="control">
          <input class="input" type="password" placeholder="********" id="InputPassword1" name="password_login" required>
        </div>
      </div>
      <hr>
      <button type="submit" class="button is-dark" name="submit_login" value="connexion">Log in</button>
      <hr>
      <div class="col">
          <p>Vous ne possédez pas de compte ? <a href="./pageinscription.php">Inscrivez-vous ici </a></p>
      </div>
    </form>

    
  </div>
</body>
</html>

