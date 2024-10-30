<?php
    include 'database.php';

    if(isset($_GET['updateArrested'])){
     
        $arrested_id = $_POST['update_Arrested_id'];
        $arrested_name = preg_replace('/\s+/', ' ',$_POST['update_Arrested_name']);
        $gender = $_POST['update_gender'];
        $dob = $_POST['update_dob'];
        $arrested_date = $_POST['update_arrest_date'];
        $arrested_time = $_POST['update_arrest_time'];
        $crime_id = $_POST['update_crime_type'];
        $location = preg_replace('/\s+/', ' ', $_POST['update_location']);
        $bail_amount = $_POST['update_bail_amount'];    
        
        if($_FILES["update_img"]["name"]!=""){

          
            $sql="SELECT  * FROM `arrested_person` WHERE arrested_id=$arrested_id";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $old_img = "../../uploads/".$row['img']; 
            unlink($old_img);

            $target_dir = "../../uploads/";
            $name=$arrested_id;
            $target_file = $target_dir  . $name . basename($_FILES["update_img"]["name"]);
            $imagename=$name . basename($_FILES["update_img"]["name"]);

            if(move_uploaded_file($_FILES["update_img"]["tmp_name"], $target_file)) {
                $sql = "UPDATE `arrested_person` SET `arrested_name`='$arrested_name',`dob`='$dob',`gender`='$gender',`arrested_date`='$arrested_date',`arrested_time`='$arrested_time',`crime_id`=$crime_id,`location`='$location',`bail_amount`='$bail_amount',`img`='$imagename' WHERE `arrested_id`=$arrested_id";
                
                if ($conn->query($sql)) {
                    echo 1;   
                } 
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
        else if($_FILES["update_img"]["name"]==""){
            
            $sql = "UPDATE `arrested_person` SET `arrested_name`='$arrested_name',`dob`='$dob',`gender`='$gender',`arrested_date`='$arrested_date',`arrested_time`='$arrested_time',`crime_id`=$crime_id,`location`='$location',`bail_amount`='$bail_amount'  WHERE `arrested_id`=$arrested_id";
                
                if ($conn->query($sql)) {
                    echo 1;   
                } 
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>