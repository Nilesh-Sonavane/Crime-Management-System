<?php
    include 'database.php';


    if($_POST['type']==""){
        $sql = "SELECT * FROM countries";
        $result=$conn->query($sql);
        $str="";
        while($row=$result->fetch_assoc()){
          $str .= "<option value='{$row['country_id']}'> {$row['country_name']} </option>";
        }
      
    }
    elseif($_POST['type']=="stateData"){
    
        $sql = "SELECT * FROM states WHERE country_id={$_POST['id']} ORDER BY state_name";
        $result=$conn->query($sql);
        $str='<option value="-1">--Select--</option>';
        while($row=$result->fetch_assoc()){
          $str .= "<option value='{$row['state_id']}'> {$row['state_name']} </option>";
        }
     
    }elseif($_POST['type']=="cityData"){
        $sql = "SELECT * FROM cities WHERE state_id={$_POST['id']} ORDER BY city_name";
        $result=$conn->query($sql);
        $str='<option value="-1">--Select--</option>';
        while($row=$result->fetch_assoc()){
          $str .= "<option value='{$row['city_id']}'> {$row['city_name']} </option>";
        }
    }else{
      $str='<option value="-1">--Select--</option>';
    }
    echo $str;

    
?>