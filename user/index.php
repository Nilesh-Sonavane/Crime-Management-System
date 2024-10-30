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
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./OwlCarousel/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="./OwlCarousel/dist/assets/owl.theme.default.min.css">
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
  <?php require './includes/slider.php'?>

    <div class="row">
      <div class="col-lg-6">
        <?php require './includes/our-service.php'?>
      </div>
      <div class="col-lg-6">
        <?php require './includes/News&Announcement.php'?>
      </div>
    </div>

  <?php require 'signin.php'?>

  <?php require './includes/footer.php'?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="./js/script.js"></script>
 
  <script src="./OwlCarousel/dist/owl.carousel.min.js"></script>


</body>
<script>
  function startSpinner(){
    $(".loader").css("display", "none");
  }
  
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
      navText: ['<i style="color:#fff" class="fa fa-angle-left fa-5x"></i>','<i style="color:#fff" class="fa fa-angle-right fa-5x"></i>'],
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
      },
    });
    
  });
  jQuery.fn.liScroll = function(settings) {
	settings = jQuery.extend({
		travelocity: 0.02
		}, settings);		
		return this.each(function(){
				var $strip = jQuery(this);
				$strip.addClass("newsticker")
				var stripHeight = 1;
				$strip.find("li").each(function(i){
					stripHeight += jQuery(this, i).outerHeight(true); // thanks to Michael Haszprunar and Fabien Volpi
				});
				var $mask = $strip.wrap("<div class='mask'></div>");
				var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");								
				var containerHeight = $strip.parent().parent().height();	//a.k.a. 'mask' width 	
				$strip.height(stripHeight);			
				var totalTravel = stripHeight;
				var defTiming = totalTravel/settings.travelocity;	// thanks to Scott Waye		
				function scrollnews(spazio, tempo){
				$strip.animate({top: '-='+ spazio}, tempo, "linear", function(){$strip.css("top", containerHeight); scrollnews(totalTravel, defTiming);});
				}
				scrollnews(totalTravel, defTiming);				
				$strip.hover(function(){
				  jQuery(this).stop();
				},
				function(){
				  var offset = jQuery(this).offset();
				  var residualSpace = offset.top + stripHeight;
				  var residualTime = residualSpace/settings.travelocity;
				  scrollnews(residualSpace, residualTime);
				});			
		});	
};

$(function(){
  $("ul#news-alerts").liScroll();
});
</script>
</html>