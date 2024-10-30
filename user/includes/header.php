<?php
  include_once './php/database.php';
  include './php/font.php';
?>


<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />  -->
<link rel="stylesheet" href="./css/all.css">

<script src="https://unpkg.com/@phosphor-icons/web"></script>

<div class="logo_header">
  <div class="logo-box">
    <div class="logo">
      <a href="index.php">
        <img class="logo" src="./images/police_logo.png"  alt="Police Logo">
      </a>
    </div>
    <div class="dg-head-text my-10">
      <!-- <div><span class="head">CRIME REPORTING PORTAL</span></div>
      <div><span class="bottom">(GOVERNMENT OF INDIA)</span></div> -->
      <div><span class="head">BharatSuraksha.com</span></div>
      <div><span class="bottom">(India Security)</span></div>
    </div>
  </div>
 
    <?php
      if(isset($_SESSION['uid'])){
        ?>
<div class="profile">
    <div class="user">
      <h3>
        <?php
          $user_id = $_SESSION['uid'];
          $sql = "SELECT * FROM user WHERE user_id=$user_id";
          $result =$conn->query($sql);
          $row = mysqli_fetch_assoc($result);
          echo ucfirst($row['fname'])."  ".ucfirst($row['lname']);
        ?>
      </h3>
      <p>
      <?php
          $user_id = $_SESSION['uid'];
          $sql = "SELECT * FROM user WHERE user_id=$user_id";
          $result =$conn->query($sql);
          $row = mysqli_fetch_assoc($result);
          echo $row['email'];
        ?>
      </p>
    </div>
		<div class="img-box">
      <?php
        $user_id = $_SESSION['uid'];
        $sql = "SELECT * FROM user WHERE user_id=$user_id";
        $result =$conn->query($sql);
        $row = mysqli_fetch_assoc($result);
      
        ?>

        <img src="../uploads/<?php echo $row['img_url']?>" alt="some user image">
			
		</div>
    
    <span id="tooltiptext" class="tooltiptext">
        <div onclick="user_profile()"><i class="ph-bold ph-user" ></i>&nbsp;Profile</li> </div>
        <div onclick="myFIR()"><i class="ph-bold ph-file" ></i>&nbsp;My FIR</li> </div>
        <div onclick="logout()"><i class="ph-bold ph-sign-out" ></i>&nbsp;Sign Out</li></div>
          
    </span>
        <?php
      }
    ?>

	</div>
    

	<!-- <div class="menu">
    <ul>
			<li><a href="#"><i class="ph-bold ph-sign-out"></i>&nbsp;Sign Out</a></li>
    </ul>
	</div> -->
</div>

  <nav class="navbar">
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>
    </label>
    <ul>
      <li><a href="index.php">Home</a></li>

      <?php
        if(!isset($_SESSION['uid'])){
          ?>
              <li><a href="#open-modal">Login/Registration</a></li>
          <?php
        }
      ?>


      <!-- <li><a href="#">Online Form</a></li> -->
      <li><a href="photo_gallery.php">Photo Gallery</a></li>
      <li><a href="contact_details.php">Contact Details</a></li>
      <!-- <li><a href="#">Know Home Department</a></li>
      <li><a href="#">Know Your Police Station</a></li>
      <li><a href="#">User Guideline</a></li>
      <li><a href="#">Absconder List</a></li>
      
      <li><a href="#">Lookout Notice</a></li> -->
    </ul>
  </nav>

<script src="./js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
  function logout() {
    (async () => {
      const {
        value: response
      } = await Swal.fire({
        icon: 'success',
        title: 'Logout successfull',
      });
        window.location.replace("php/logout.php");
        
      })()
    }


    function user_profile(){

      window.location.replace("./user_profile.php");
      // alert("Helllo Nilesh");
    }

    function myFIR(){
      window.location.replace("./myFIR.php");
    }
</script>


<?php 
  if(isset($_SESSION['uid'])){
    ?>
        <script>
            var profile = document.querySelector('.profile');
            var tooltiptext = document.querySelector('.tooltiptext');

            profile.onmouseenter = function () {
              tooltiptext.classList.add('active'); 
            }
            profile.onmouseleave = function () {
              tooltiptext.classList.remove('active');
            }
        </script>
    <?php
  }
?>
