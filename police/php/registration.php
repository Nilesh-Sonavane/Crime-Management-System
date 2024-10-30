<?php
    include 'database.php';

    
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $city = $_POST['city'];
    $rank = $_POST['rank'];
    $police_station = $_POST['police_station'];


    $sql_count = "SELECT * FROM police WHERE email='$email'";
    $result_count =$conn->query($sql_count);
    $row_count = mysqli_num_rows($result_count); 
    $check_police_email = $row_count;


    $sql_count1 = "SELECT * FROM police WHERE contact='$contact'";
    $result_count1 =$conn->query($sql_count1);
    $row_count1 = mysqli_num_rows($result_count1); 
    $check_police_phone = $row_count1;

     // ******************* Encryption of password **************** 
     $hashedPassword = password_hash($pass,PASSWORD_DEFAULT);
     // ********************* end ************************

    $sql = "INSERT INTO police(first_name,middle_name,last_name,dob,contact,email,pass,city_id,rank_id,station_id) VALUES('$first_name','$middle_name','$last_name','$dob','$contact','$email','$hashedPassword',$city,$rank,$police_station)";

    if($row_count==1){
        echo "1";
    }else if($check_police_phone==1){
        echo "2";
    }else{
         if ($conn->query($sql)) {
            echo "ok";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

?>