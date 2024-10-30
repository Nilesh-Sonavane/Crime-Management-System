
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="./css/all.css">
<!-- <link rel="stylesheet" href="./css/all.min.css"> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
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
  <h3 style="font-family: 'Montserrat', sans-serif;font-size:30px;">Admin</h3>
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
   <li>
    <a href="slider.php">
    <span class='glyphicon'><img src="./images/slider-white.png" height="25px;" weight="25px"></span>Slider 
    </a>
   </li>
   <li>
    <a href="police.php">
     <span class='glyphicon'><img src="./images/policeman-white.png" height="25px" weight="25px"></span> Police
    </a>
   </li>
   <li>
    <a href="policeStation.php">
     <span class='glyphicon'><img src="./images/police-station-white.png" height="25px" weight="25px"></span> Police Station 
    </a>
   </li>

   <li>
    <a href="users.php">
     <span class='glyphicon'><i class="fas fa-user" style="font-size:25px"></i></span> Users
    </a>
   </li>
   <li>
    <a href="fir.php">
     <span class='glyphicon'><img src="./images/fir-white.png" height="25px" weight="25px"></span> FIR
    </a>
   </li>
   <li>
    <a href="arrestedPerson.php">
     <span class='glyphicon'><img src="./images/police-handcuffs-white.png" height="25px" weight="25px"></span> Arrested Person
    </a>
   </li>
   <li>
    <a href="crimeType.php">
     <span class='glyphicon'><img src="./images/siron-white.png" height="25px" weight="25px"></span> Crime Type
    </a>
   </li>
   <li>
    <a href="media.php">
     <span class='glyphicon'><i class="fas fa-image" style="font-size:25px"></i></span> Media
    </a>
   </li>
   <li>
    <a href="news&announcement.php">
     <span class='glyphicon'><img src="./images/news.png" height="25px" weight="25px"></span> News
    </a>
   </li>
   
  </ul>
  <ul class='main-menu bottom'>
   <li>
    <a style="color:#fff;cursor:pointer" onclick="logout()">
     <span class='glyphicon'><i class="fas fa-sign-out-alt" aria-hidden="true" style="font-size:25px"></i></span> Logout

    </a>
   </li>
  </ul>
 </div>
 <p class="copyright">&copy; 2024</p>
</nav>
<!-- Navigation - End  -->
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
</script>