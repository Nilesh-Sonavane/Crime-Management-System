<?php
    include 'database.php';

    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $rank = $_POST['rank'];
    $police_station = $_POST['police_station'];


    $sql_count = "SELECT * FROM police WHERE email='$email' And NOT police_id='$id'";
    $result_count =$conn->query($sql_count);
    $row_count = mysqli_num_rows($result_count); 
    $check_police_email = $row_count;


    $sql_count1 = "SELECT * FROM police WHERE contact='$contact' And NOT police_id='$id'";
    $result_count1 =$conn->query($sql_count1);
    $row_count1 = mysqli_num_rows($result_count1); 
    $check_police_phone = $row_count1;


    $sql = "UPDATE police SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',dob='$dob',contact='$contact',email='$email',city_id='$city',rank_id='$rank',station_id='$police_station' WHERE police_id=$id";

    if($check_police_email==1){
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