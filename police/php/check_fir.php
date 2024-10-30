<?php
   include 'database.php';
    if(isset($_REQUEST['fid'])){

        $fir_id = $_REQUEST['fid'];

        $sql = "SELECT * FROM fir WHERE fir_id=$fir_id";
        $result =$conn->query($sql);
        $row = $result->fetch_assoc();
        $crime_id = $row['crime_id'];

        if($crime_id==1){
            // header('Location: mobile_fir_detail.php?fid=$fir_id');
            ?>
                <script>
                    window.location.href = "../mobile_fir_detail.php?id=<?php echo $fir_id?>";
                </script>
            <?php

        }else if($crime_id==2){
            // header('Location: vehical_fir_detail.php?fid=$fir_id');
            ?>
                <script>
                    window.location.href = "../vehical_fir_detail.php?id=<?php echo $fir_id?>";
                </script>
        <?php
        }


    }else{
        echo "no";
    }
    
?>