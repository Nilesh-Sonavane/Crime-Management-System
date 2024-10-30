<?php
    include_once './php/database.php';
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BharatSuraksha</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
  <link rel="stylesheet" href="./css/all.css">
  <link rel="shortcut icon" href="./images/Police_Logo.png" type="image/x-icon">

</head>

<body onload="startSpinner()">
    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>
  <?php require './includes/header.php'?>
  


  <div class="container">

<!-- <h1 class="heading">Image Gallery with CSS Grid <span>& Flexbox Fallback</span></h1> -->

<div class="gallery">

	<?php
		$conn = new mysqli('localhost','root','','crime_management_system');
		$sql = "SELECT * FROM media";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()){
	?>
	<div class="gallery-item">
		<img class="gallery-image" src="<?php echo "../uploads/".$row['img_name']?>" alt="Image notfound">
	</div>
	<?php
		}

	?>


	<!-- <div class="gallery-item">
		<img class="gallery-image" src="https://i.pinimg.com/1200x/f0/a5/2f/f0a52ff5c4bd61871db8fce58c249368.jpg" alt="person writing in a notebook beside by an iPad, laptop, printed photos, spectacles, and a cup of coffee on a saucer">
	</div> -->

</div>

</div>



  <?php require 'signin.php'?>
 
  <?php require './includes/footer.php'?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="./js/script.js"></script>
  <script>
    function startSpinner(){
            $(".loader").css("display", "none");
        }  
  </script>
  
</body>

</html>