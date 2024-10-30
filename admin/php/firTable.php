<?php include 'database.php'; ?>

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
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM fir";
                        $result = mysqli_query($conn, $sql);
                        $i=1;
                        while($row = $result->fetch_assoc()){
                        $crime = $row['crime_id'];
                        $user = $row['user_id'];
                        $date = $row['fir_date'];
                        $time = $row['fir_time'];
                        $status = $row['fir_status'];                   
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
                    </tr>
                </tfoot>
            </table>


<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
    })
</script>