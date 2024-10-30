<?php
  include 'database.php';
  if(isset($_POST['email'])){

    // $2y$10$w7I210xt1G6xVer.Ol.7vu1rj0h7KWaorhBwR1gJ/OOZZoDEXQZfy
  
    $email = $_POST['email'];
    $password = $_POST['password'];

     // ******************* Encryption of password **************** 
     $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
     // ********************* end ************************

    $sql = "UPDATE police SET `pass`='$hashedPassword' WHERE email='$email'"; 
    
    // echo $email;
    if($conn->query($sql)){
        echo "1";
      }
      else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
  }
?>