<?php
    include 'database.php';

    if(isset($_GET['saveUser'])){

        $userId = $_SESSION['uid'];

        $first_name = $_POST['first-name'];
        $middle_name = $_POST['middle-name'];
        $last_name = $_POST['last-name'];
        $email  = $_POST['email'];
        $contact = $_POST['mobail-no'];
        $dob = $_POST['dob'];
        $aadhar = $_POST['aadhar'];
        $add = $_POST['address'];
        $address = preg_replace('!\s+!', ' ', $add);


        $sql_count = "SELECT * FROM user WHERE email='$email' And NOT user_id='$userId'"; 
        $result_count =$conn->query($sql_count);
        $row_count = mysqli_num_rows($result_count); 
        $check_user_email = $row_count;


        $sql_count1 = "SELECT * FROM user WHERE contact='$contact' And NOT user_id='$userId'";
        $result_count1 =$conn->query($sql_count1);
        $row_count1 = mysqli_num_rows($result_count1); 
        $check_user_phone = $row_count1;
        
        $sql_count2 = "SELECT * FROM user WHERE aadhar_no='$aadhar' And NOT user_id='$userId'";
        $result_count2 =$conn->query($sql_count2);
        $row_count2 = mysqli_num_rows($result_count2); 
        $check_user_aadhar = $row_count2;

       


        if($check_user_email==1){
            echo 1;
        }else if($check_user_phone==1){
            echo 2;
        }else if($check_user_aadhar==1){
            echo 3;
        }else{

            if($_FILES["imageUpload"]["name"]==""){

                $sql = "UPDATE `user` SET `fname`='$first_name',`mname`='$middle_name',`lname`='$last_name',`email`='$email',`contact`='$contact',`dob`='$dob',`aadhar_no`='$aadhar',`address`='$address' WHERE `user_id`=$userId";

                if ($conn->query($sql)) {
                    echo "0";   
                } 
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }else{

                $target_dir = "../../uploads/";
                $sql="SELECT  MAX(user_id) FROM `user`";
                $result=$conn->query($sql);
                $row=$result->fetch_assoc();
                $name=$row['MAX(user_id)']+1;
                $target_file = $target_dir  . $name . basename($_FILES["imageUpload"]["name"]);
                $imagename=$name . basename($_FILES["imageUpload"]["name"]);

                if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE `user` SET `fname`='$first_name',`mname`='$middle_name',`lname`='$last_name',`email`='$email',`contact`='$contact',`dob`='$dob',`aadhar_no`='$aadhar',`address`='$address',`img_url`='$imagename' WHERE `user_id`=$userId";
    
                    if ($conn->query($sql)) {
                        echo "0";   
                    } 
                    else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
        
                }else{
                    echo "Sorry, there was an error uploading your file.";
                }
            }

          
            
            
        }








    }


?>