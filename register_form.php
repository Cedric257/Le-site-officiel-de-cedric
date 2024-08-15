<?php @include 'header.php' ; ?>
<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $name1 = mysqli_real_escape_string($conn, $_POST['name1']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user WHERE Email = '$email' && Password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Utilisateur deja existant!';

   }else{

      if($pass != $cpass){
         $error[] = 'Le mot de passe est different!';
      }else{
         $insert = "INSERT INTO user(Nom, Prenom, Email, Password, Profil) VALUES('$name','$name1','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
         echo 'Vous avez inscrit avec succes!';
      }
   }

};


?>

   
<div class="form-container">

   <form action="" method="post">
      <h3>S'inscrire</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <label for="">Nom</label>
      <input type="text" name="name" required placeholder="Enter your first name">
      <label for="">Prenom</label>
      <input type="text" name="name1" required placeholder="Enter your name">
      <label for="">Addresse email</label>
      <input type="email" name="email" required placeholder="Enter your email">
      <label for="">Mot de passe</label>
      <input type="password" name="password" required placeholder="Enter your password">
      <label for=""> Confirmez le mot de passe</label>
      <input type="password" name="cpassword" required placeholder="Confirm your password">
      <label for="">Profil</label>
      <select name="user_type">
         <option value="user">Client</option>
         <option value="admin">Professionnel</option>
      </select>
      <input type="submit" name="submit" value="S'inscrire maintenant" class="form-btn">
      <p>Vous avez un compte? <a href="login_form.php" class="form-btn">Connexion</a></p>
   </form>

</div>

</body>
</html>