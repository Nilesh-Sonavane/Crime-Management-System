<?php
    include 'database.php';

    if(isset($_GET['addsliderImage'])){

        $target_dir = "../../uploads/";

        $sql="SELECT  MAX(id) FROM `slider`";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
       // $name=date("(Y-m-d)(h-i-s)");
        
        $name=$row['MAX(id)']+1;
        $target_file = $target_dir  . $name . basename($_FILES["file"]["name"]);
        $imagename=$name . basename($_FILES["file"]["name"]);
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO `slider` (`img`) VALUES ('$imagename')";
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
    if(isset($_GET['deleteSliderImage'])){
        $id=$_GET['deleteSliderImage'];
        $target_dir = "../../uploads/";
        $sql = "SELECT * FROM slider WHERE id=$id";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $imgname=$row['img'];
        $target_file = $target_dir  . $imgname;
        if (file_exists($target_file)){
            unlink($target_file);
            $sql = "DELETE FROM `slider`  WHERE id=$id";
             if ($conn->query($sql)) {
                echo "1";
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }    
    }
    if(isset($_GET['addmediaImage'])){
        $target_dir = "../../uploads/";
        $sql="SELECT  MAX(img_id) FROM `media`";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
       // $name=date("(Y-m-d)(h-i-s)");
        
        $name=$row['MAX(img_id)']+1;
        $target_file = $target_dir  . $name . basename($_FILES["file"]["name"]);
        $imagename=$name . basename($_FILES["file"]["name"]);
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO `media` (`img_name`) VALUES ('$imagename')";
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

    if(isset($_GET['deleteMediaImage'])){
        $id=$_GET['deleteMediaImage'];
        $target_dir = "../../uploads/";
        $sql = "SELECT * FROM media WHERE img_id=$id";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $imgname=$row['img_name'];
        $target_file = $target_dir  . $imgname;
        if (file_exists($target_file)){
            unlink($target_file);
            $sql = "DELETE FROM `media`  WHERE img_id=$id";
             if ($conn->query($sql)) {
                echo "1";
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }    
    }
    if(isset($_POST['crimeValue'])){
       
        $crime_type = strtolower($_POST['crimeValue']);
        $sql_count = "SELECT * FROM `crimetype` WHERE `crime_name`= '$crime_type'";   
        $result_count =$conn->query($sql_count);
        $row_count = mysqli_num_rows($result_count); 
        $check_crime_type = $row_count;

        if($check_crime_type==1){
            echo "0";
        }else{
            $sql = "INSERT INTO crimetype(crime_name) VALUES('$crime_type')";
            if ($conn->query($sql)) {
                echo "1";
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    if(isset($_GET['getCrime_id'])){

        $id=$_GET['getCrime_id'];
        $sql = "SELECT * FROM crimetype WHERE crime_id=$id";
        $result =$conn->query($sql);
        $row = mysqli_fetch_array($result);
        echo json_encode($row); 
        // echo $row;
    } 

    if(isset($_GET['updateCrimeId'])){
       
        $crime_id = $_GET['crimeId'];
        $crime_name =strtolower($_GET['crimeName']);

        $sql_count = "SELECT * FROM `crimetype` WHERE `crime_name`= '$crime_name'";   
        $result_count =$conn->query($sql_count);
        $row_count = mysqli_num_rows($result_count); 
        $check_crime_type = $row_count;
    
        if($check_crime_type==1){
            echo "0";
        }else{
            $sql = "UPDATE crimetype SET crime_name='$crime_name' WHERE crime_id=$crime_id";
            if ($conn->query($sql)) {
               echo "1";
            } 
            else {
               echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }   
    }

    if(isset($_GET['deleteCrime'])){
        $id=$_GET['deleteCrime'];
        
    
            $sql = "DELETE FROM crimetype  WHERE crime_id=$id";
            if ($conn->query($sql)) {
                echo "1";
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
    }    

    if(isset($_POST['stationName'])){
        
        $Station_name = strtolower($_POST['stationName']);
        $address = strtolower($_POST['address']);
        $city = $_POST['city'];
        $contact = $_POST['contact'];

        $sql_count = "SELECT * FROM `police_station` WHERE `station_name`='$Station_name'";   
        $result_count =$conn->query($sql_count);
        $row_count = mysqli_num_rows($result_count); 
        $check_station_name = $row_count;


        $sql_count = "SELECT * FROM `police_station` WHERE `contact`='$contact'";   
        $result_count =$conn->query($sql_count);
        $row_count = mysqli_num_rows($result_count); 
        $check_contact = $row_count;


        if($check_station_name==1){
            echo 0;
        }
        else if($check_contact == 1){
            echo 1;
        }else{
            $sql = "INSERT INTO police_station(station_name,address,city_id,contact) VALUES('$Station_name','$address',$city,'$contact')";
            if ($conn->query($sql)) {
                echo 2;
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

    }

    if(isset($_GET['getStation_id'])){

        $id=$_GET['getStation_id'];
        $sql = "SELECT * FROM police_station WHERE station_id=$id";
        $result =$conn->query($sql);
        $row = mysqli_fetch_array($result);
        echo json_encode($row); 
    } 

    if(isset($_GET['updateStationId'])){
        
        $station_id = $_GET['stationId'];
        $station_name = $_GET['stationName'];
        $address = $_GET['address'];
        $contact=$_GET['contact'];

        $sql_count = "SELECT * FROM `police_station` WHERE `station_name`='$station_name' AND NOT `station_id`=$station_id ";   
        $result_count =$conn->query($sql_count);
        $row_count = mysqli_num_rows($result_count); 
        $check_station_name = $row_count; 
        
        $sql_count = "SELECT * FROM `police_station` WHERE `contact`='$contact' AND NOT `station_id`=$station_id";   
        $result_count =$conn->query($sql_count);
        $row_count = mysqli_num_rows($result_count); 
        $check_contact = $row_count;

        if($check_station_name==1){
            echo "0";
        }
        else if($check_contact == 1){
            echo "1";
        }else{
            $sql = "UPDATE police_station SET station_name='$station_name', address='$address', contact='$contact' WHERE station_id=$station_id";
            if ($conn->query($sql)) {
                echo "2";
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

    }

    if(isset($_GET['deleteStation'])){
        $id=$_GET['deleteStation'];
        
    
            $sql = "DELETE FROM police_station  WHERE station_id=$id";
            if ($conn->query($sql)) {
                echo "1";
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
    }   
    if(isset($_POST['news_headline'])){

        $news_headline = $_POST['news_headline'];
        $news_link = $_POST['news_link'];
        $date = date("Y-m-d");

            
        $sql = "INSERT INTO `news&announcement`(`date`, `link`, `text`) VALUES ('$date','$news_link','$news_headline')";
        if ($conn->query($sql)) {
            echo "1";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    if(isset($_GET['getNews_id'])){

        $id=$_GET['getNews_id'];
        $sql = "SELECT * FROM `news&announcement` WHERE  id=$id";
        $result =$conn->query($sql);
        $row = mysqli_fetch_array($result);
        echo json_encode($row); 
    } 
    if(isset($_GET['updateNewsId'])){
        
        $news_id = $_GET['news_id'];
        $news_headline = $_GET['news_headline'];
        $news_link = $_GET['news_link'];

        $sql = "UPDATE `news&announcement` SET `link`='$news_link',`text`='$news_headline' WHERE `id`=$news_id";
        if ($conn->query($sql)) {
            echo "1";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    if(isset($_GET['deleteNews'])){
        $id=$_GET['deleteNews'];
        
    
            $sql = "DELETE FROM `news&announcement` WHERE id=$id";
            if ($conn->query($sql)) {
                echo "1";
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
    }   
     
?>