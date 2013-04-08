<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/index/fader.css" />
<div id="sliderWrap">
	<div id="slideshow">
		<ul id="slides">
			<li>
				<div id="singleSlide">
					<a href="#"><div>
					<img src="<?php bloginfo('template_directory');?>/images/slider/TownHall.jpg" width="475" height="249" alt="Image One" /></div></a>
					<div class="sliderText">
					<h2>Student Town Hall</h2><hr />
					<div class="desc">
						Date: Monday, Oct. 29, 2012<br />
						Time: 5:00pm – 7:00pm<br />
						Location: Nanticoke Room (Stamp 1238)
					</div>
					</div>
				</div>
			</li>
			<li>
				<div id="singleSlide">
				<img src="aast/images/slider/img1.png" width="475" height="249" alt="Image Two" />
				<div class="sliderText">
					<h2>Header 2</h2><hr />
					<div class="desc">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					</div>
					</div>
				</div>
			</li>
			<li>
				<div id="singleSlide">
				<img src="aast/images/slider/img1.png" width="475" height="249" alt="Image Three" />
				<div class="sliderText">
					<h2>Header 3</h2><hr />
					<div class="desc">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					</div>
					</div>
				</div>
			</li>
			<li>
				<div id="singleSlide">
				<img src="aast/images/slider/img1.png" width="475" height="249" alt="Image Four" />
				<div class="sliderText">
					<h2>Header 4</h2><hr />
					<div class="desc">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					</div>
					</div>
				</div>
			</li>
		</ul>
				
	</div>
</div>
	<div id="pagination" class="pagination">
		<ul>
		<li onclick="slideshow.pos(0)"></li>
		<li onclick="slideshow.pos(1)"></li>
		<li onclick="slideshow.pos(2)"></li>
		<li onclick="slideshow.pos(3)"></li>
		<!--<li id="pausePlay"><a onclick="javascript.slideshow.pausePlay()"></a></li>-->
		</ul>
	</div>

<script type="text/javascript">
var slideshow=new TINY.fader.fade('slideshow',{
	id:'slides',
	auto:6,
	resume:true,
	navid:'pagination',
	activeclass:'current',
	visible:true,
	position:0
});
</script>

