<?php

    include_once 'database.php';

    $query = "SELECT DATE(fir_date) as report_date, DAYNAME(fir_date) as day_name, COUNT(*) as num_firs FROM fir GROUP BY report_date";


    // $query = "SELECT DATE(fir_date) as report_date, DAYNAME(fir_date) as day_name, COUNT(*) as num_firs FROM fir WHERE fir_date >= CURDATE() - INTERVAL 6 DAY GROUP BY report_date";

    $result = $conn->query($query);
    $rows = mysqli_num_rows($result);

    // Create an array for the chart data
    if($rows != 0){
        $data = array();
        $data[] = array('Date or Day', 'Number of FIRs');
                            
        while ($row = $result->fetch_assoc()) {
            $data[] = array($row['day_name']."\n".$row['report_date'], (int)$row['num_firs']);
        }
                            
        echo json_encode($data);
    }
?>