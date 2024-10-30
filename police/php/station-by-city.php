<?php
 
    require_once "database.php";
 
    $city_id = $_POST["city_id"];
 
    $result = mysqli_query($conn,"SELECT * FROM police_station where city_id = $city_id ORDER BY station_name");

    $str = '<option value="-1" >--Select--</option>';
    while($row = mysqli_fetch_array($result)){
        $str .= "<option value='{$row['station_id']}'> {$row['station_name']} </option>";
    }
    echo $str;
?>