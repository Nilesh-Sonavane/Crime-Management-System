<?php include 'database.php'; ?>



<?php 
                    $police_id = $_SESSION['pid'];
                    $sql = "SELECT * FROM police WHERE police_id=$police_id";
                    $result =$conn->query($sql);
                    $row = $result->fetch_assoc();
                  
                    $station_id = $row['station_id'];
                    // $sql = "SELECT * FROM police_station WHERE station_id=$station_id";
                    // $result =$conn->query($sql);
                    // $row = $result->fetch_assoc();
                    //   $station_name = $row['station_name'];

                    //   echo $station_name;
                    
                    ?>


<script src="./DataTables/js/jquery.js"></script>
    <script src="./DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="./DataTables/media/css/jquery.dataTables.min.css">


<table id="myTable" class="display table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Crime</th>
                        <th>User Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>View</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $sql_mobile = "SELECT * FROM fir WHERE fir_id in(SELECT fir_id from mobile_fir WHERE station_id=$station_id)";
                        $result_mobile = mysqli_query($conn, $sql_mobile);
                        $i=1;
                        while($row_mobile = $result_mobile->fetch_assoc()){
                            $crime = $row_mobile['crime_id'];
                            $user = $row_mobile['user_id'];
                            $date = $row_mobile['fir_date'];
                            $time = $row_mobile['fir_time'];
                            $status = $row_mobile['fir_status'];
                            ?>
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td>
                                        <?php 
                                            $sql_crime = "SELECT * FROM crimetype WHERE crime_id=$crime";
                                            $result_crime = mysqli_query($conn, $sql_crime);
                                            $row_crime = $result_crime->fetch_assoc();
                                            echo $row_crime['crime_name'];
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                            $sql_user = "SELECT * FROM user WHERE user_id=$user";
                                            $result_user = mysqli_query($conn, $sql_user);
                                            $row_user = $result_user->fetch_assoc();
                                            echo ucwords(strtolower($row_user['fname']))." ".ucwords(strtolower($row_user['mname']))." ".ucwords(strtolower($row_user['lname']));
                                        ?>
                                    </td>
                                    <td><?php echo $date;?></td>
                                    <td><?php echo $time;?></td>
                                    <td>
                                        <?php
                                            $sql_status = "SELECT * FROM fir_status WHERE status_id=$status";
                                            $result_status = mysqli_query($conn, $sql_status);
                                            $row_status = $result_status->fetch_assoc();
                                            echo $row_status['status_name'];
                                        ?>
                                    </td>
                                    <td class="view"><a href="./php/check_fir.php?fid=<?php echo $row_mobile['fir_id']?>"><i class="fas fa-eye"></i></a></td>
                                </tr>
                            <?php
                        }


                        $sql_vehical = "SELECT * FROM fir WHERE fir_id in(SELECT fir_id from vehical_fir WHERE station_id=$station_id)";
                        $result_vehical = mysqli_query($conn, $sql_vehical);
                        while($row_vehical = $result_vehical->fetch_assoc()){
                            $crime = $row_vehical['crime_id'];
                            $user = $row_vehical['user_id'];
                            $date = $row_vehical['fir_date'];
                            $time = $row_vehical['fir_time'];
                            $status = $row_vehical['fir_status'];
                            ?>
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td>
                                        <?php 
                                            $sql_crime = "SELECT * FROM crimetype WHERE crime_id=$crime";
                                            $result_crime = mysqli_query($conn, $sql_crime);
                                            $row_crime = $result_crime->fetch_assoc();
                                            echo $row_crime['crime_name'];
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                            $sql_user = "SELECT * FROM user WHERE user_id=$user";
                                            $result_user = mysqli_query($conn, $sql_user);
                                            $row_user = $result_user->fetch_assoc();
                                            echo ucwords(strtolower($row_user['fname']))." ".ucwords(strtolower($row_user['mname']))." ".ucwords(strtolower($row_user['lname']));
                                        ?>
                                    </td>
                                    <td><?php echo $date;?></td>
                                    <td><?php echo $time;?></td>
                                    <td>
                                        <?php
                                            $sql_status = "SELECT * FROM fir_status WHERE status_id=$status";
                                            $result_status = mysqli_query($conn, $sql_status);
                                            $row_status = $result_status->fetch_assoc();
                                            echo $row_status['status_name'];
                                        ?>
                                    </td>
                                    <td class="view"><a href="./php/check_fir.php?fid=<?php echo $row_vehical['fir_id']?>"><i class="fas fa-eye"></i></a></td>
                                </tr>   
                            <?php
                        }
                    ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>Sr No</th>
                        <th>Crime</th>
                        <th>User Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                </tfoot>
            </table>


<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
    })
</script>