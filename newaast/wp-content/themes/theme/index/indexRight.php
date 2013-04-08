<section id="events">
	<h2><b>EVENTS</b> CALENDAR</h2>
	<div class="section-content clearfix">	
	<div style="margin: 10px;">
	<?php sidebarEventsCalendar();?>
	</div>
	<div class="section-content clearfix">
	

	</div>
</section>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="subscribe-min">
	<ul class="social">
		<li><a class="social-twitter" href="http://twitter.com/aastumd" rel="nofollow" target="_blank">Twitter</a></li>
		<li><a class="social-facebook" href="http://www.facebook.com/aastumd" rel="nofollow" target="_blank">Facebook</a></li>	
		<li><div class="fb-like" data-href="http://www.facebook.com/aastumd" data-send="false" data-layout="box_count" data-width="90" data-show-faces="false" data-font="lucida grande"></div></li>
	</ul>
	<div class="clear"></div>
</div>


<?php include('spotlight.php') ?>

