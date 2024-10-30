<?php include 'database.php'; ?>

<script src="./DataTables/js/jquery.js"></script>
    <script src="./DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="./DataTables/media/css/jquery.dataTables.min.css">


<table id="myTable" class="display table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Police Name</th>
                        <th>Police Station</th>
                        <th>Bail Amount</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM arrested_person";
                        $result = mysqli_query($conn, $sql);
                        $i=1;
                        while($row = $result->fetch_assoc()){
                        $name = $row['arrested_name'];
                        $gender = $row['gender'];
                        $date = $row['arrested_date'];
                        $time = $row['arrested_time'];
                        $police_id = $row['police_id'];  
                        $station_id = $row['station_id'];
                        $bail_amount = $row['bail_amount'];


                        ?>
                            <tr>
                                <td><?php echo $i++;?></td>
                                <td><?php echo ucwords(strtolower(($name)));?></td>
                                <td><?php echo $gender;?></td>
                                <td><?php echo $date;?></td>
                                <td><?php echo $time;?></td>
                                <td>
                                   <?php 
                                        $sql_police = "SELECT * FROM police WHERE police_id=$police_id";
                                        $result_police = mysqli_query($conn, $sql_police);
                                        $row_police = $result_police->fetch_assoc();
                                        echo ucwords(strtolower(($row_police['first_name'])))." ".ucwords(strtolower(($row_police['middle_name'])))." ".ucwords(strtolower(($row_police['last_name'])));
                                   ?>
                                </td>
                                <td>
                                    
                                    <?php 
                                        $sql_station = "SELECT * FROM police_station WHERE station_id=$station_id";
                                        $result_station = mysqli_query($conn, $sql_station);
                                        $row_station = $result_station->fetch_assoc();
                                        echo ucwords(strtolower(($row_station['station_name'])));
                                   ?> 
                                </td>
                                <td>₹<?php echo $bail_amount;?></td>
                                
                                
                            </tr>
                        <?php
                        }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Police Name</th>
                        <th>Police Station</th>
                        <th>Bail Amount</th>
                    </tr>
                </tfoot>
            </table>


<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
    })
</script>