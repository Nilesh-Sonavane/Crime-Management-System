<?php
    include 'database.php';
    if(isset($_GET['getPerson_id'])){
        $id=$_GET['getPerson_id'];
        $sql = "SELECT * FROM wanted_person WHERE person_id=$id";
        $result =$conn->query($sql);
        $row = mysqli_fetch_array($result);
        echo json_encode($row); 
    }

    if(isset($_GET['deletePerson'])){

        $id=$_GET['deletePerson'];
        
        $target_dir = "../../uploads/";
        $sql = "SELECT * FROM wanted_person WHERE person_id=$id";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $imgname=$row['photo_url'];
        $target_file = $target_dir  . $imgname;
        if (file_exists($target_file)){
            unlink($target_file);
            $sql = "DELETE FROM wanted_person  WHERE person_id=$id";
            if ($conn->query($sql)) {
                echo "1";
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } 
    }

    if(isset($_GET['getArrested_id'])){
        
        $id=$_GET['getArrested_id'];
        $sql = "SELECT * FROM arrested_person WHERE arrested_id=$id";
        $result =$conn->query($sql);
        $row = mysqli_fetch_array($result);
        echo json_encode($row); 
    }
    
    if(isset($_GET['deleteArrested'])){

        $id=$_GET['deleteArrested'];

        $sql="SELECT  * FROM `arrested_person` WHERE arrested_id=$id";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        $old_img = "../../uploads/".$row['img']; 
   
      
            unlink($old_img);
            $sql = "DELETE FROM arrested_person  WHERE arrested_id=$id";
            if ($conn->query($sql)) {
                echo "1";
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        
    }
    
?>