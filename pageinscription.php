<?php $page = 'signup'; ?>
<?php require 'inc/header.php'; ?>

<?php

if (!empty($_POST['email_signup']) && !empty($_POST['password1_signup']) && !empty($_POST['password2_signup']) && !empty($_POST['username_signup']) &&  isset($_POST['submit_signup'])) {
    $email = htmlspecialchars($_POST['email_signup']);
    $password1 = htmlspecialchars($_POST['password1_signup']);
    $password2 = htmlspecialchars($_POST['password2_signup']);
    $username = htmlspecialchars($_POST['username_signup']);

    try {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sqlMail = "SELECT * FROM users WHERE email = '{$email}'";
            $resultMail = $connect->query($sqlMail);
            $countMail = $resultMail->fetchColumn();
            if (!$countMail) {
                $sqlUsername = "SELECT * FROM users WHERE username = '{$username}'";
                $resultUsername = $connect->query($sqlUsername);
                $countUsername = $resultUsername->fetchColumn();
                if (!$countUsername) {
                    if ($password1 === $password2) {
                        $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                        $sth = $connect->prepare("INSERT INTO users (email,username,password) VALUES (:email,:username,:password)");
                        $sth->bindValue(':email', $email);
                        $sth->bindValue(':username', $username);
                        $sth->bindValue(':password', $hashedPassword);
                        $sth->execute();
                        echo "L'utilisateur a bien été enregistré !";
                    } else {
                        echo "Les mots de passe ne sont pas concordants.";
                        unset($_POST);
                    }
                } else {
                    echo " Ce nom d'utilisateur existe déja";
                    unset($_POST);
                }
            } else {
                echo "Un compte existe déja pour cette adresse mail";
                unset($_POST);
            }
        } else {
            echo "L'adresse email saisie n'est pas valide";
            unset($_POST);
        }
    } catch (PDOException $error) {
        echo 'Error: ' . $error->getMessage();
    }
}

?>


<div class='formulaire'>
    <form class="box" action="#" method="POST">
      <div class="field">
        <label class="label" for="InputUsername1">Nom</label>
        <div class="control">
          <input class="input" type="texte" placeholder="Jean Eude Dupont" id="InputUsername1" aria-describedby="userHelp" name="username_signup" required>
        </div>
      </div>
      <div class="field">
        <label class="label" for="InputEmail1">Email</label>
        <div class="control">
          <input class="input" type="email" placeholder="cestpasmoi@gmail.com" id="InputEmail1" aria-describedby="emailHelp" name="email_signup" required>
        </div>
      </div>
      <div class="field">
        <label class="label" for="InputPassword1">Password</label>
        <div class="control">
          <input class="input" type="password" placeholder="********" id="InputPassword1" name="password1_signup" required>
        </div>
      </div>

      <div class="field">
        <label class="label" for="InputPassword2">Confirm Password</label>
        <div class="control">
          <input class="input" type="password" placeholder="********" id="InputPassword2" name="password2_signup" required>
        </div>
        <hr>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="Check1" required>
          <label class="form-check-label" for="Check1">Accepter les <a href="#">termes et conditions</a></label>
          </div>
      </div>
      <hr>
      <button type="submit" class="button is-dark" name="submit_signup" value="inscription">Sing in</button>
      

      <hr>
        <div class="row">
          <div class="col">
              <p>Déja inscrits ? <a href="./pageconnexion.php">Connectez-vous ici </a></p>
          </div>
        </div>
    </form>
  </div>
</body>
</html>