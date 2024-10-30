<?php
 
    require_once "database.php";
 
    $state_id = $_POST["state_id"];
 
    $result = mysqli_query($conn,"SELECT * FROM cities where state_id = $state_id ORDER BY city_name");

    $str = '<option value="-1" >--Select--</option>';
    while($row = mysqli_fetch_array($result)){
        $str .= "<option value='{$row['city_id']}'> {$row['city_name']} </option>";
    }
    echo $str;
?>