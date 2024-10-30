<?php

    include_once 'database.php';

    $police_id = $_SESSION['pid'];

    $sql = "SELECT * FROM police where police_id=$police_id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $station_id = $row['station_id'];

    $query = "SELECT DATE(arrested_date) as report_date, COUNT(*) as num_arrested FROM arrested_person WHERE station_id= $station_id GROUP BY report_date";
    // echo $station_id;
    $result = $conn->query($query);
    $rows = mysqli_num_rows($result);

    // Create an array for the chart data
    if($rows != 0){
        $data = array();
        $data[] = array('Date', 'Number of Arrested Persons');
                            
        while ($row = $result->fetch_assoc()) {
            $data[] = array($row['report_date'], (int)$row['num_arrested']);
        }
                            
        echo json_encode($data);
    }
?>