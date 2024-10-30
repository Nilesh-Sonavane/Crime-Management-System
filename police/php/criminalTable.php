<?php include 'database.php'; ?>

<script src="./DataTables/js/jquery.js"></script>
    <script src="./DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="./DataTables/media/css/jquery.dataTables.min.css">


<table id="myTable" class="display table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Person Name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Height</th>
                        <th>Weight</th>
                        <th>Eye Color</th>
                        <th>Hair Color</th>
                        <th>Nationality</th>
                        <th>Reward</th>
                        <th>Image</th>
                        <th>Last Known Location</th>
                        <th>Description</th>
                        <th>Added Date</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $police_id = $_SESSION['pid'];
                        $sql = "SELECT * FROM wanted_person where police_id=$police_id";
                        $result = mysqli_query($conn, $sql);
                        $i=1;
                        while($row = $result->fetch_assoc()){
                        
                                                  
                    ?>
                        <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo ucwords(strtolower($row['person_name']))?></td>
                            <td><?php echo $row['dob']?></td>
                            <td><?php echo $row['gender']?></td>
                            <td><?php echo $row['height']?></td>
                            <td><?php echo $row['weight']?></td>
                            <td><?php echo $row['eye_color']?></td>
                            <td><?php echo $row['hair_color']?></td>
                            <td><?php echo $row['nationality']?></td>
                            <td><?php echo $row['reward']?></td>
                            <td><a href="#popup1" class="text-dark fw-bold" style="cursor:pointer;" onclick="getimage('<?php echo $row['photo_url']; ?>');">View Image</a></td>
                            <td><?php echo $row['last_known_location']?></td>
                            <td><?php echo $row['description']?></td>
                            <td><?php echo $row['added_date']?></td>
                            <td><i class="far fa-edit" onclick="getPersonInfo(<?php echo $row['person_id'];?>)"></i> <i class="fa fa-times-circle" onclick="deletePerson(<?php echo $row['person_id'];?>)"></i></td>
                            
                            
                            
                        </tr>
                    <?php
                        }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                    <th>Sr No</th>
                        <th>Person Name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Height</th>
                        <th>Weight</th>
                        <th>Eye Color</th>
                        <th>Hair Color</th>
                        <th>Nationality</th>
                        <th>Reward</th>
                        <th>Image</th>
                        <th>Last Known Location</th>
                        <th>Description</th>
                        <th>Added Date</th>
                        <th>Operation</th>
                    </tr>
                </tfoot>
            </table>


<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
    })
</script>