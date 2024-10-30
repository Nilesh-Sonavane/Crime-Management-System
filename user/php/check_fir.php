<?php
     
     if(isset($_GET['crime_id'])){
        
        $id = $_GET['crime_id'];
        
        if($id==1){
            header('Location:../mobile_fir.php?id='.$id);
        }
        else if($id==2){
            header('Location:../vehical_fir.php?id='.$id);
        }

    }
?>