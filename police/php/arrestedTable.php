<?php include 'database.php'; ?>

<script src="./DataTables/js/jquery.js"></script>
    <script src="./DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="./DataTables/media/css/jquery.dataTables.min.css">


<table id="myTable" class="display table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Arrested Name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Arrest Date</th>
                        <th>Arrest Time</th>
                        <th>Crime Type</th>
                        <th>Location</th>
                        <th>Bail Amount</th>
                        <th>Payment Id</th>
                        <th>Image</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        $police_id = $_SESSION['pid'];
                        $sql = "SELECT * FROM arrested_person where police_id=$police_id";
                        $result = mysqli_query($conn, $sql);
                        $i=1;
                        while($row = $result->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo ucwords(strtolower($row['arrested_name']))?></td>
                            <td><?php echo $row['dob']?></td>
                            <td><?php echo $row['gender']?></td>
                            <td><?php echo $row['arrested_date']?></td>
                            <td><?php echo $row['arrested_time']?></td>
                            <td>
                                <?php  
                                    $crime_id = $row['crime_id'];
                                    $crime_sql = "SELECT * FROM crimetype where crime_id=$crime_id";
                                    $crime_result = mysqli_query($conn, $crime_sql);
                                    $crime_row = $crime_result->fetch_assoc();
                                    echo $crime_row['crime_name'];
                                ?>
                            </td>
                            <td><?php echo ucwords(strtolower($row['location']))?></td>
                            <td><?php echo $row['bail_amount']?></td>
                            <td><?php echo $row['payment_id']?></td>
                            <td><a href="#popup1" class="text-dark fw-bold" style="cursor:pointer;" onclick="getimage('<?php echo $row['img']; ?>');">View Image</a></td>
                           
                            <td><i class="far fa-edit" onclick="getPersonInfo(<?php echo $row['arrested_id'];?>)"></i> <i class="fa fa-times-circle" onclick="deletePerson(<?php echo $row['arrested_id'];?>)"></i></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Sr No</th>
                        <th>Arrested Name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Arrest Date</th>
                        <th>Arrest Time</th>
                        <th>Crime Type</th>
                        <th>Location</th>
                        <th>Bail Amount</th>
                        <th>Payment Id</th>
                        <th>Image</th>
                        <th>Operation</th>
                    </tr>
                </tfoot>
            </table>


<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
    })
</script>