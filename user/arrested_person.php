<?php
    include_once './php/database.php';
    if(!isset($_SESSION['uid'])){
        header('Location:index.php#open-modal');
    }

    $uid = $_SESSION['uid'];
    $sql = "SELECT * FROM user WHERE user_id=$uid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $user_name = ucfirst($row['fname'])." ".ucfirst($row['mname'])." ".ucfirst($row['lname']);
    $user_contact = $row['contact'];
    $user_email = $row['email'];

?> 
<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BharatSuraksha</title>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/arrested_person.css">
  <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
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
    <form>
        <div class="page-title">
            <h2>Get a Arrested Person</h2>
        </div>
        <div class="container1">
             <label style="margin-top: 0;margin-bottom: 1rem;margin-left:20px"> <storng>All fields marked with <span class="require">*</span> are mandatory </storng> </label>

            <div class="row">
                <div class="col-md-5">
                    <label for="dob">Date Of Birth</label><span class="require">*</span>
                    <input type="date" name="dob" id="dob">
                    <small><span class="Error dob_err">* It Is reqired</span></small>
                </div>
                <div class="col-md-2">
                    <hr>
                </div>
                <div class="col-md-5">
                    <label for="arrested_date">Arrested Date</label><span class="require">*</span>
                    <input type="date" name="arrested_date" id="arrested_date">
                    <small><span class="Error arrested_date_err">* It Is reqired</span></small>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                     <label for="country"  class="country">Country</label><span class="require">*</span>
                    <select id="country" name="country" id="country">
                        <option value="-1">--Select--</option>
                        <?php
                            $sql = "SELECT * FROM countries";
                            $result =$conn->query($sql);
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                    <option value="<?php echo $row['country_id'];?>"><?php echo $row['country_name'];?></option>
                                    <?php
                                }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <hr>
                </div>
                <div class="col-md-5">
                    <label for="state"  class="state">State</label><span class="require">*</span>
                    <select  id="state" name="state" id="state">
                        <option value="-1" selected>--Select--</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label for="city"  class="city">City</label><span class="require">*</span>
                    <select  id="city" name="city" id="city">
                        <option value="-1" selected>--Select--</option>
                    </select>    
                </div>
                <div class="col-md-2">
                    <hr>
                </div>
                <div class="col-md-5">
                    <label for="police_station">Police Station</label>
                    <select  id="police_station" class="police_station" name="police_station">
                        <option  value="1" selected>-- Select --</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
    
    <form class="form" action="payment_process.php" method="POST">
        <div class="container2">
            <table class="rwd-table">
                <thead>
                    <tr>
                        <th>IMG</th>
                        <th>NAME</th>
                        <th>Arrested Date</th>
                        <th>Police Station</th>
                        <th>Bail Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_GET['dob']) && isset($_GET['arrested_date']) && isset($_GET['station_id'])){
                            $dob = $_GET['dob'];
                            
                            $arrested_date = $_GET['arrested_date'];
                            $station_id = $_GET['station_id'];
                            $sql = "SELECT * FROM arrested_person WHERE dob='$dob' AND arrested_date = '$arrested_date' AND station_id=$station_id";
                            $result = $conn->query($sql);
                            $rowcount = mysqli_num_rows($result);
                            if($rowcount!=0){
                                while($row = $result->fetch_assoc()){
                                    ?>
                                        <input type="hidden" id="arrested_id" value="<?php echo $row['arrested_id'];?>">
                                        <input type="hidden" name="bail_amount" id="bail_amount" value="<?php echo $row['bail_amount'];?>">
                                        <tr>
                                            <td data-th="IMG"> <img src=".././uploads/<?php echo $row['img']?>" hight="100px" width="200px"  alt="Image"> </td>
                                            <td data-th="Name"><?php echo ucfirst($row['arrested_name']);?>  </td>
                                            <td data-th="Arrested Date"><?php echo $row['arrested_date'];?></td>
                                            <td data-th="police station">
                                                <?php $id =  $row['station_id'];
                                                    $station_sql = "SELECT * FROM police_station WHERE  station_id=$id";
                                                    $station_result = $conn->query($station_sql); 
                                                    $station_row = $station_result->fetch_assoc();
                                                    echo ucfirst($station_row['station_name']);
                                                    ?>
                                            </td>
                                            <td data-th="Bail Amount">₹<?php echo $row['bail_amount'];?></td>
                                            
                                            <td data-th="Pay Now">
                                                <?php
                                                    $payment_id = $row['payment_id'];

                                                    if( $row['payment_id'] =="Pending"){
                                                        ?>
                                                            <input type="submit" value="Pay Now" class="btn btn-danger"></input>

                                                        <?php
                                                    }else{
                                                        ?>

                                                            <a href="./php/dounloadPaymentRecipt.php?id=<?php echo $row['payment_id']?>" style="color:white;">Payment Recipt</a>
                                                        <?php
                                                    }   
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                }
                            }
                        }
                        ?>
                </tbody>  
            </table>
            <div class="row">
                <div class="buttons">
                    <input type="button" class="mx-2 btn btn-sm btn-secondary" value="Generate Report" onclick="submit1()">
                    <input type="button" class="mx-2 btn btn-sm btn-secondary" value="Reset" onclick="reset1()">
                </div>
            </div>
        </div>
    </form>
        
        
    

  <?php require 'signin.php'?>
  
  <?php require './includes/footer.php'?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="./js/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="./js/script.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
  <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
  
  <script>

// feature date and time disable 

const day = new Date().toISOString().split('T')[0];
            document.getElementById("arrested_date").setAttribute("max", day);
            
    
        // **************** end *********


        // validate date and time disable 
        const d = new Date();

        let fullYear = d.getFullYear()-18;
        let m = (d.getMonth()+1);
        let month = m<10?('0'+m):m;
        let dt = d.getDate();
        let date =  dt<10?('0'+dt):dt;
        const today = fullYear+"-"+month+"-"+date;
        document.getElementById("dob").setAttribute("max", today);
        

        // **************** end *********


    function startSpinner(){
        $(".loader").css("display", "none");
    }  
    $(document).ready(function(){

        $('#country').on('change',function(){
                var country_id = this.value;
                if(country_id!="-1"){
                    $.ajax({
                        url: "./php/states-by-country.php",
                        type: "POST",
                        data: {
                            country_id: country_id
                        },
                        cache: false,
                        success: function(result){
                            $("#state").html(result);
                        }
                    });
                }else{
                    $("#state").html('<option value="-1" >--Select--</option>');
                    $("#city").html('<option value="-1" >--Select--</option>');
                    $("#police_station").html('<option value="-1" >--Select--</option>');
                }
                
        });

            $('#state').on('change', function() {
                var state_id = this.value;
                if(state_id!="-1"){
                    $.ajax({
                        url: "./php/cities-by-state.php",
                        type: "POST",
                        data: {
                            state_id: state_id
                        },
                        cache: false,
                        success: function(result){
                            $("#city").html(result);
                        }
                    });
                }else{
                    $("#city").html('<option value="-1" >--Select--</option>');
                    $("#police_station").html('<option value="-1" >--Select--</option>');
                }
                
            });

            $('#city').on('change', function() {
                var city_id = this.value;
                if(city_id!="-1"){
                    $.ajax({
                        url: "./php/station-by-city.php",
                        type: "POST",
                        data: {
                            city_id: city_id
                        },
                        cache: false,
                        success: function(result){
                            $("#police_station").html(result);
                        }
                    });
                }else{
                    $("#police_station").html('<option value="-1" >--Select--</option>');
                }
                
            });
    });
    function submit1(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-center',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true, 
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        var dob = document.getElementById("dob").value.trim();
        var arrested_date = document.getElementById("arrested_date").value.trim();
        var country = document.getElementById("country").value.trim();
        var state = document.getElementById("state").value.trim();
        var city = document.getElementById("city").value.trim();
        var police_station = document.getElementById("police_station").value.trim();

        if(dob!="" && arrested_date!="" && country!=-1 && state!=-1 && city!=-1 && police_station!=-1){
            $(".loader").show();
            window.location.href = "arrested_person.php?dob="+dob+"&arrested_date="+arrested_date+"&station_id="+police_station;
        }else{
            Toast.fire({    
                icon: 'error',
                title: 'All fileds are required'
            });
        }

    }
    function reset1(){
        window.location.replace("arrested_person.php");
    }
    document.querySelector(".form").addEventListener("submit", function (e) {
        e.preventDefault();

        var amount = document.getElementsByName("bail_amount")[0].value;

        // Make an AJAX request to create a Razorpay order
        fetch('payment_process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                amount: amount,
            }),
        })
        .then(response => response.json())
        .then(data => {
            
            var options = {
                key: 'rzp_test_TKsUUrpIbgmKdJ',
                amount: data.amount,
                currency: 'INR',
                name: 'Crime Management System',
                description: 'Payment for your product/service',
                image:'https://upload.wikimedia.org/wikipedia/en/9/91/Odisha_Police_Logo.png',
                order_id: data.orderId,
                handler: function (response) {
                    console.log(response);
                    // Handle the success callback
                    // alert('Payment successful: ' + response.razorpay_payment_id);
                    
                    var uid ='<?php echo $uid?>';
                    var payment_id = response.razorpay_payment_id;
                    var order_id = data.orderId;
                    var arrested_id = $('#arrested_id').val();

                   
                    $(".loader").show();
                    $.ajax({
                        url: "./php/sendPaymentEmail.php",
                        type: "POST",
                        data: {
                            uid:uid,
                            payment_id:payment_id,
                            order_id:order_id,
                            arrested_id:arrested_id
                        },
                        success: function(response) {
                            if(response == 1){
                                $(".loader").hide();    
                                Swal.fire({
                                icon: "success",
                                title: "Payment Successfully",
                                text :"Payment Id: " + payment_id
                                }).then((result) => {
                                    window.location.reload();
                                })
                            }else{
                                console.log(response);  
                            }
                        }
                    });
                },
                prefill: {
                    name: '<?php echo $user_name;?>',
                    email: '<?php echo $user_email;?>',
                    contact: '<?php echo $user_contact;?>',
                },
                theme: {
                    color: '#528FF0',
                },
            };
            

            var rzp1 = new Razorpay(options);
            rzp1.open();
        })
        .catch(error => {
            console.error('Error creating Razorpay order:', error);
        });
    });

      </script>
</body>

</html>