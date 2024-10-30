<?php
    include 'database.php';

    if(isset($_GET['addArrest'])){


        $pid = $_SESSION['pid'];
        $sql = "SELECT * FROM police where police_id=$pid";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();
        $police_station = $row['station_id'];

        $arrested_name = preg_replace('/\s+/', ' ', $_POST['Arrested_name']);
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $arrested_date = $_POST['arrest_date'];
        $arrested_time = $_POST['arrest_time'];
        $crime_id = $_POST['crime_type'];
        $location = preg_replace('/\s+/', ' ',$_POST['location']);
        
        $bail_amount = $_POST['bail_amount'];

        $target_dir = "../../uploads/";
        $sql="SELECT  MAX(arrested_id) FROM `arrested_person`";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();

        $name=$row['MAX(arrested_id)']+1;
        $target_file = $target_dir  . $name . basename($_FILES["img"]["name"]);
        $imagename=$name . basename($_FILES["img"]["name"]);

        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {

            $sql = "INSERT INTO `arrested_person`(`arrested_name`, `dob`, `gender`, `arrested_date`, `arrested_time`, `crime_id`, `location`, `bail_amount`, `img`, `police_id`, `station_id`) VALUES ('$arrested_name','$dob','$gender','$arrested_date','$arrested_time',$crime_id,'$location','$bail_amount','$imagename',$pid,$police_station)";
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