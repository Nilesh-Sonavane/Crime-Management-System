<?php
    include 'database.php';

    if(isset($_GET['addcrim'])){

        $police_id = $_SESSION['pid'];
        $person_name = $_POST['criminal_name'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $eye_color = $_POST['eye_color'];
        $hair_color = $_POST['hair_color'];
        $nationality = $_POST['nationality'];
        $reward = $_POST['reward'];
        // $img_url = $_POST['nationality'];
        $last_known_location = $_POST['last_known_location'];
        $description = $_POST['description'];
        $added_date = date("Y-m-d");



        $target_dir = "../../uploads/";
        $sql="SELECT  MAX(person_id) FROM `wanted_person`";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
       // $name=date("(Y-m-d)(h-i-s)");
       
        $name=$row['MAX(person_id)']+1;
        $target_file = $target_dir  . $name . basename($_FILES["file"]["name"]);
        $imagename=$name . basename($_FILES["file"]["name"]);
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

            $sql = "INSERT INTO wanted_person(police_id, person_name, dob, gender, height, weight, eye_color, hair_color, nationality, reward, photo_url, last_known_location, description, added_date) VALUES ($police_id,'$person_name','$dob','$gender','$height','$weight','$eye_color','$hair_color','$nationality','$reward','$imagename','$last_known_location','$description','$added_date')";
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