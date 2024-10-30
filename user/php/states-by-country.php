<?php
 
    require_once "database.php";
 
    $country_id = $_POST["country_id"];
 
    $result = mysqli_query($conn,"SELECT * FROM states where country_id = $country_id");

    $str = '<option value="-1" >--Select--</option>';
    while($row = mysqli_fetch_array($result)){
        $str .= "<option value='{$row['state_id']}'> {$row['state_name']} </option>";
    }
    echo $str;
?>