<?php @include 'header.php' ; ?>
<?php
@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM user WHERE Email = '$email' && Password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['Profil'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }elseif($row['Profil'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'Mot de passe incorecte!';
   }

};
?>


   
<div class="form-container">

   <form action="" method="post">
     <h3>Connectez-vous</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
          <label class="field-input">Addresse Email</label>
      <input type="email" name="email" required placeholder="Enter your email"> 
          <label class="field-input">Mot de Passe</label>
      <input type="password" name="password" required placeholder="Enter your password">
       <i class="fas fa-eye"></i>
      <input type="submit" name="submit" value="Connexion" class="form-btn">
      <p>Vous n'est pas inscrit? <a href="register_form.php" class="form-btn">S'inscrire maintenant</a></p>
   </form>

</div>

</body>
</html>