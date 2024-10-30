<?php include 'database.php'; ?>

<script src="./DataTables/js/jquery.js"></script>
    <script src="./DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="./DataTables/media/css/jquery.dataTables.min.css">


<table id="myTable" class="display table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Aadhar No</th>
                        <th>Address</th>
                        <th>State</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM user";
                        $result = mysqli_query($conn, $sql);
                        $i=1;
                        while($row = $result->fetch_assoc()){
                        
                                                  
                    ?>
                        <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo ucwords(strtolower($row['fname']))." ".ucwords(strtolower($row['mname']))." ".ucwords(strtolower($row['lname']));?></td>
                            <td><?php echo $row['email']?></td>
                            <td><?php echo $row['contact']?></td>
                            <td><?php echo $row['gender']?></td>
                            <td><?php echo $row['dob']?></td>
                            <td><?php echo $row['aadhar_no']?></td>
                            <td><?php echo ucwords(strtolower($row['address']))?></td>
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
                        </tr>
                    <?php
                        }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Aadhar No</th>
                        <th>Address</th>
                        <th>State</th>
                        <th>City</th>
                    </tr>
                </tfoot>
            </table>


<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
    })
</script>