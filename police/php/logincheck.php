<?php
     include 'database.php';

	//   $email=$_POST['email'];
   //   $pass=$_POST['pass'];
   //   $sql = "SELECT * FROM police WHERE email='$email' and pass='$pass'";
   //   $result = mysqli_query($conn, $sql);

   //   if(mysqli_num_rows($result) > 0)
   //   {
   //    $row = mysqli_fetch_assoc($result);
   //    $_SESSION["pid"] =$row['police_id'];        
   //    echo "1";   
   //   }
   //   else{
   //      echo "wrong Email or Password";
   //   }
    

   $email=$_POST['email'];
   $pass=$_POST['pass'];
   $sql = "SELECT * FROM `police` WHERE email='$email'";
   $result = mysqli_query($conn, $sql);

   if(mysqli_num_rows($result) > 0)
   {
      $row = mysqli_fetch_assoc($result);
      $verify = password_verify($pass,$row['pass']);
      if($verify==1){
         $_SESSION["pid"] =$row['police_id'];        
         echo "1";
      }else{
         echo "Wrong Password";
      }
   }
   else{
      echo "Email Not Registered";
   }

?>