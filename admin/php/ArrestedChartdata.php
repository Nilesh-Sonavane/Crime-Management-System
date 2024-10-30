<?php

    include_once 'database.php';

    $query = "SELECT DATE(arrested_date) as report_date, COUNT(*) as num_arrested FROM arrested_person GROUP BY report_date";
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