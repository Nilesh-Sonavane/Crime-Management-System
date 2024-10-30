<?php include 'database.php'; ?>

<script src="./DataTables/js/jquery.js"></script>
    <script src="./DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="./DataTables/media/css/jquery.dataTables.min.css">

<div class="table-responsive">
<table id="myTable" class="table table-striped table-hover" >
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Date</th>
                        <th>Hedline</th>
                        <th>Link</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM `news&announcement` WHERE 1";
                        $result = mysqli_query($conn, $sql);
                        $i=1;
                        while($row = $result->fetch_assoc()){
                        
                                                  
                        ?>
                            <tr>
                                <td><?php echo $i++;?></td>
                                <td><?php echo $row['date'];?></td>
                                <td><?php echo $row['text']?></td>
                                <td><a href="<?php echo $row['link']?>" target="_black">View</a></td>
                                <td><i class="far fa-edit" onclick="getNewsInfo(<?php echo $row['id'];?>)"></i> <i class="fa fa-times-circle" onclick="deleteNews(<?php echo $row['id'];?>)"></i></td>
                            </tr>
                        <?php
                        }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sr No</th>
                        <th>Date</th>
                        <th>Hedline</th>
                        <th>Link</th>
                        <th>Operation</th>  
                    </tr>
                </tfoot>
</table>
</div>


<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
    })
</script>