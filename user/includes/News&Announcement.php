<div class="services-container news-box" style="padding:0px">
    <div class="box-header" style="background-color: #281859;height:40px; margin-bottom:20px;padding:5px">
		<strong style="color: white;">News & Announcement</strong>
	</div>
	<div class="news-alerts holder">
		<ul id="news-alerts" class="news-alert-list">
			<?php
				$conn = new mysqli('localhost','root','','crime_management_system');
				$sql = "SELECT * FROM `news&announcement`";
				$result = $conn->query($sql);

				
				while($row = $result->fetch_assoc()){

					$dateString = $row['date'];
					$date = new DateTime($dateString);
				?>
					<li><span><span class="date-display-single" property="dc:date" datatype="xsd:dateTime" content="<?php echo $row['date']?>"><?php echo $date->format("d"); ?>&nbsp;</span><span class="date-<?php echo $row['date']?>"><?php echo $date->format("M"); ?>:&nbsp;</span></span><a href="<?php echo $row['link']?>" target="_blank"><p><?php echo $row['text']?></p></a></li>
				<?php
				}
			?>

		</ul>
	</div>
</div>
<script src="../jQuery-slimScroll/jquery.slimscroll.min.js"></script>
<script>


</script>
