<?php include 'database.php'; ?>

<table class="table table-striped">
                    <thead>
                        <th>Sr no</th>
                        <th>Crime Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            
                            $sql = "SELECT * FROM crimetype";
                            $result = mysqli_query($conn, $sql);
                            $i=0;
                            while($row = $result->fetch_assoc()){
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo ucwords(strtolower($row['crime_name']));?></td>
                                    <td><i class="far fa-edit" onclick="getCrimeInfo(<?php echo $row['crime_id'];?>)"></i></td>
                                </tr>
                                <?php
                            }
                           
                        ?>
                        
                    </tbody>
                </table>