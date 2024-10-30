<section class="testimonials">
    <div id="customers-testimonials" class="owl-carousel">
    
    <?php
		$conn = new mysqli('localhost','root','','crime_management_system');
		$sql = "SELECT * FROM slider";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()){
        ?>
            <div class="item">
                <div class="shadow-effect">
                    <img class="pull-right" src="<?php echo "../uploads/".$row['img'];?>" alt="">
                    <!-- <div class="slider-caption">
                        <div class="top-caption">
                            <h2>welcome to</h2>
                        </div>
                        <div class="middle-caption">
                            <h2>BharatSurakha</h2>
                        </div>
                        <div class="bottom-caption">
                            <h2>restaurent</h2>
                        </div>	
                    </div> -->
                </div>
            </div>
        <?php
        }
    ?>
    </div>
</section>

<!-- END OF TESTIMONIALS -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        "use strict";
        //  TESTIMONIALS CAROUSEL HOOK
        $('#customers-testimonials').owlCarousel({
            loop: true,
            items: 3,
            margin: 0,
            autoplay: true,
            dots:true,
            nav:true,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            autoHeight:true,
        navText: ['<i class="fa fa-angle-left fa-5x"></i>','<i class="fa fa-angle-right fa-5x"></i>'],
            responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            1170: {
                items: 1
            }
            }
        });
    });
</script>