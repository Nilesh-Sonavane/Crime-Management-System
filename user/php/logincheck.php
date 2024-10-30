<?php
     include 'database.php'; 

   $email=$_POST['email'];
   $pass=$_POST['pass'];
   $sql = "SELECT * FROM `user` WHERE email='$email'";
   $result = mysqli_query($conn, $sql);

   if(mysqli_num_rows($result) > 0)
   {
      $row = mysqli_fetch_assoc($result);
      $verify = password_verify($pass,$row['password']);
      if($verify==1){
         $_SESSION["uid"] =$row['user_id'];        
         echo "1";
      }else{
         echo "Wrong Password";
      }
   }
   else{
      echo "Email Not Registered";
   }


?>