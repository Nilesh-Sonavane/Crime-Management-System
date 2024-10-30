<?php
    include 'database.php';

    if(isset($_GET['updatecrim'])){

        $police_id = $_SESSION['pid'];
        $person_id = $_POST['update-criminal_id'];
        $person_name = $_POST['update-criminal_name'];
        $gender = $_POST['update-gender'];
        $dob = $_POST['update-dob'];
        $height = $_POST['update-height'];
        $weight = $_POST['update-weight'];
        $eye_color = $_POST['update-eye_color'];
        $hair_color = $_POST['update-hair_color'];
        $nationality = $_POST['update-nationality'];
        $reward = $_POST['update-reward'];
        // $img_url = $_POST['nationality'];
        $last_known_location = $_POST['update-last_known_location'];
        $description = $_POST['update-description'];
        $added_date = date("Y-m-d");

        $target_dir = "../../uploads/";
        $sql="SELECT  MAX(person_id) FROM `wanted_person`";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
       // $name=date("(Y-m-d)(h-i-s)");
       
        $name=$row['MAX(person_id)']+1;
        $target_file = $target_dir  . $name . basename($_FILES["update-file"]["name"]);
        $imagename=$name . basename($_FILES["update-file"]["name"]);
        if (move_uploaded_file($_FILES["update-file"]["tmp_name"], $target_file)) {

            $sql = "UPDATE `wanted_person` SET `police_id`=$police_id,`person_name`='$person_name',`dob`='$dob',`gender`='$gender',`height`='$height',`weight`='$weight',`eye_color`='$eye_color',`hair_color`='$hair_color',`nationality`='$nationality',`reward`='$reward',`photo_url`='$imagename',`last_known_location`='$last_known_location',`description`='$description' WHERE person_id=$person_id";
             if ($conn->query($sql)) {
                echo "1";   
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }else{
            echo "Sorry, there was an error uploading your file.";
        }
        

    }



?>