<?php
    include_once './php/database.php';
    if(!isset($_SESSION['uid'])){
        header('Location:index.php#open-modal');
      }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wanted Person</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/wanted_person.css">
  <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
  <link rel="stylesheet" href="./css/all.css">
  <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">


</head>

<body>
  
  <?php require './includes/header.php'?>
  
    <div class="container">
        <div class="row">

            <?php
                $conn = new mysqli('localhost','root','','crime_management_system');
                $sql = "SELECT * FROM wanted_person";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()){
                    ?>
                        <div class="col-md-4">
                            <ul class="card-wrapper">
                                <li class="card">
                                    <img src="../uploads/<?php echo $row['photo_url']?>" alt="Image not found">
                                    <h3><?php echo $row['person_name']?></h3>
                                    <p><span class="bold">DOB:</span> <?php echo $row['dob']?></p>
                                    <p><span class="bold">Gender:</span> <?php echo $row['gender']?></p>
                                    <p><span class="bold">Height:</span> <?php echo $row['height']?></p>
                                    <p><span class="bold">Weight:</span> <?php echo $row['weight']?></p>
                                    <p><span class="bold">Eye Color:</span> <?php echo $row['eye_color']?></p>
                                    <p><span class="bold">Hair Color:</span> <?php echo $row['hair_color']?></p>
                                    <p><span class="bold">Nationality:</span> <?php echo $row['nationality']?></p>
                                    <p><span class="bold">Reward:</span> <?php echo $row['reward']?></p>
                                    <p><span class="bold">Last Known Location:</span> <?php echo $row['last_known_location']?></p>
                                    <p><span class="bold">Description:</span> <?php echo $row['description']?></p>
                                </li>
                            </ul>
                        </div>
                    <?php
                }
            ?>

        </div>
    </div>

  <?php require 'signin.php'?>
 
  <?php require './includes/footer.php'?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="./js/script.js"></script>
 
  
</body>

</html>