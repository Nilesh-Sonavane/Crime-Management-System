<?php

    include 'database.php';

    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email  = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $aadhar = $_POST['aadhar'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pass = $_POST['pass'];


    
    $sql_count = "SELECT * FROM user WHERE email='$email'";
    $result_count =$conn->query($sql_count);
    $row_count = mysqli_num_rows($result_count); 
    $check_user_email = $row_count;
    
    
    $sql_count1 = "SELECT * FROM user WHERE contact='$contact'";
    $result_count1 =$conn->query($sql_count1);
    $row_count1 = mysqli_num_rows($result_count1); 
    $check_user_phone = $row_count1;
    
    $sql_count2 = "SELECT * FROM user WHERE aadhar_no='$aadhar'";
    $result_count2 =$conn->query($sql_count2);
    $row_count2 = mysqli_num_rows($result_count2); 
    $check_user_aadhar = $row_count2;
    
    
    // ******************* Encryption of password **************** 
    $hashedPassword = password_hash($pass,PASSWORD_DEFAULT);
    // ********************* end ************************

    if($gender=="Male"){
        $sql = "INSERT INTO user( fname,mname,lname,email,contact,gender,dob,aadhar_no,address, city_id, password,img_url) VALUES ('$first_name','$middle_name','$last_name','$email','$contact','$gender','$dob','$aadhar','$address',$city,'$hashedPassword','male-user.png')";
    }else if($gender=="Female"){
        $sql = "INSERT INTO user( fname,mname,lname,email,contact,gender,dob,aadhar_no,address, city_id, password,img_url) VALUES ('$first_name','$middle_name','$last_name','$email','$contact','$gender','$dob','$aadhar','$address',$city,'$hashedPassword','female-user.png')";             
    }


    // $sql = "INSERT INTO user( fname,mname,lname,email,contact,gender,dob,aadhar_no,address, city_id, password) VALUES ('$first_name','$middle_name','$last_name','$email','$contact','$gender','$dob','$aadhar','$address',$city,'$pass')";


    if($check_user_email==1){
        echo "1";
    }else if($check_user_phone==1){
        echo "2";
    }else if($check_user_aadhar==1){
        echo "3";
    }else{
         if ($conn->query($sql)) {

            echo "0";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>