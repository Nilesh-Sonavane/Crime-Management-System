<?php include 'database.php'; ?>

<script src="./DataTables/js/jquery.js"></script>
    <script src="./DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="./DataTables/media/css/jquery.dataTables.min.css">

<div class="table-responsive">
<table id="myTable" class="table table-striped table-hover" >
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Rank</th>
                        <th>Police Station</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM police";
                        $result = mysqli_query($conn, $sql);
                        $i=1;
                        while($row = $result->fetch_assoc()){
                        
                                                  
                    ?>
                        <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo ucfirst($row['first_name'])." ".ucfirst($row['middle_name'])." ".ucfirst($row['last_name']);?></td>
                            <td><?php echo $row['dob']?></td>
                            <td><?php echo $row['contact']?></td>
                            <td><?php echo $row['email']?></td>
                            <td>
                                <?php
                                    $city=$row['city_id'];
                                    $sql_city = "SELECT * FROM cities WHERE city_id=$city";
                                    $result_city = mysqli_query($conn, $sql_city);
                                    
                                    while($row_city = $result_city->fetch_assoc()){

                                        $state=$row_city['state_id'];
                                        $sql_state = "SELECT * FROM states WHERE state_id=$state";
                                        $result_state = mysqli_query($conn, $sql_state);
                                        while($row_state = $result_state->fetch_assoc()){
                                             echo $row_state['state_name'];
                                        }
                                        
                                    }
                                ?>
                            </td>
                            <td> 
                                <?php
                                    $city=$row['city_id'];
                                    $sql_city = "SELECT * FROM cities WHERE city_id=$city";
                                    $result_city = mysqli_query($conn, $sql_city);
                                    
                                    while($row_city = $result_city->fetch_assoc()){
                                        echo $row_city['city_name'];
                                    }
            
                                ?>
                            </td> 
                            
                            <td>
                                <?php
                                    $rank = $row['rank_id'];
                                    $sql_rank = "SELECT * FROM police_ranks WHERE rank_id=$rank";
                                    $result_rank = $conn->query($sql_rank);
                                    while($row_rank = $result_rank->fetch_assoc()){
                                        echo $row_rank['rank_name'];
                                    }
                                ?>
                            </td>
                            <td>
                            <?php
                                    $station = $row['station_id'];
                                    $sql_station = "SELECT * FROM police_station WHERE station_id=$station";
                                    $result_station = $conn->query($sql_station);
                                    while($row_station = $result_station->fetch_assoc()){
                                        echo ucfirst($row_station['station_name']);
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Rank</th>
                        <th>Police Station</th>
                    </tr>
                </tfoot>
</table>
</div>


<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
    })
</script>