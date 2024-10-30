
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="./css/all.css">

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="./css/style.css">
<?php include 'font.php'?>

<!-- Header - Start  -->
<header id="header">
 <div class="menu-button">
  <div id="nav-icon3">
   <span></span>
   <span></span>
   <span></span>
   <span></span>
  </div>
 </div>
 <div id="top-bar">
  <h3 style="font-family: 'Montserrat', sans-serif;">Police<span>

  (<?php
            $police_id = $_SESSION['pid'];
            $sql = "SELECT * FROM police WHERE police_id=$police_id";
            $result =$conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            $station_id =  $row['station_id'];

            $station_sql = "SELECT * FROM police_station WHERE station_id=$station_id";
            $station_result =$conn->query($station_sql);
            $station_row = mysqli_fetch_assoc($station_result);
            $station_name =  $station_row['station_name'];
            echo ucfirst($station_name);


    ?>)</span>
  <span style="float:right;font-size:20px;font-family: 'Tangerine', cursive;">Welcome  <?php
        $police_id = $_SESSION['pid'];
        $sql = "SELECT * FROM police WHERE police_id=$police_id";
        $result =$conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        echo ucfirst($row['first_name'])."  ".ucfirst($row['last_name']);
  ?></span>
  </h3>
  
 </div>
</header>
<!-- Header - End  -->
<!-- Navigation - Start  -->
<nav id="sidemenu">
 <div class="main-menu">
  <ul class='main-menu'>
  <li>
    <a href="index.php">
     <span class="glyphicon"><i class="fas fa-tachometer-alt" style="font-size:25px"></i></span> Dashboard
    </a>
   </li>
   <li>
    <a href="fir.php">
     <span class='glyphicon'><img src="./images/fir-white.png" height="25px" weight="25px"></span> FIR
     </select>
    </a>
   </li>
   <li>
    <a href="criminal.php">
     <span class='glyphicon'><img src="./images/wanted-white.png" height="25px" weight="25px"></span> Wanted
     </select>
    </a>
   </li>
   <li>
    <a href="ArrestedPerson.php">
     <span class='glyphicon'><img src="./images/police-handcuffs-white.png" height="25px" weight="25px"></span> Arressted
     </select>
    </a>
   </li>
  </ul>
  <ul class='main-menu bottom'>
  <li>
    <a href="../police/police_profile.php" style="color:#fff;cursor:pointer">
     <span class='glyphicon'><i class="fas fa-user-alt" style="font-size:25px"></i></span> Profile
    </a>
   </li>
   <li>
    <a style="color:#fff;cursor:pointer" onclick="logout()">
     <span class='glyphicon'><i class="fas fa-sign-out-alt" style="font-size:25px"></i></span> Logout
    </a>
   </li>
  </ul>
 </div>
 <p class="copyright">&copy; 2024</p>
</nav>
<!-- Navigation - End  -->
<script src="./js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
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
</script>
