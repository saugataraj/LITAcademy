<section>
	<div class="container-fluid" id="inner_footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h4>LIT Academy</h4>
					<p>No. 3B, Orchard Court, 123 Chamiers Road, R. A. Puram, Chennai - 600 028 </p>
					<p>Phone : +91 000 1234 1234,  +91 000 1234 1234   |    E-mail : <a href="mailto:info@domain.in">info@domain.in</a></p>
				</div>
			</div>
		</div>
	</div>
</section>

<footer>
	<div class="container" id="footer">
		<div class="row">
			<div  class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3 col-sm-3 col-xs-12 mobile">
					<h3>Contact us</h3>					
					<p>LIT Academy <br/>Research and Development <br/> No. 3B, Orchard Court,<br/>
 123 Chamiers Road,<br/> R. A.Puram, <br/> Chennai - 600 028</p>
					<h3>Social Links</h3>
					<ul class="social-icons icon-circle icon-rotate list-unstyled list-inline"> 
				      <li><a href="https://www.facebook.com/LIT-Academy-1154447691296167/" target="_blank"><i class="fa fa-facebook"></i></a> </li> 
				      <li><a href="https://twitter.com/academy_lit" target="_blank"><i class="fa fa-twitter"></i></a> </li>   
				      <li> <a href="https://plus.google.com/118286737323063129665" target="_blank"><i class="fa fa-google-plus"></i></a> </li>
				    </ul>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 mobile">
					<h3>About us</h3>
					<ul>
						<li><a href="aboutus.php">Introducing Innovation</a></li>
						<li><a href="aboutus.php#aboutlab">What is Innovation</a></li>
						<li><a href="whyus.php">Why is innovation</a></li>
						<li><a href="advantage.php">Advantage of Innovation</a></li>
						<li><a href="how_we_work.php">How does the Innovation Works</a></li>
						<li><a href="derivates.php">Derivatives of Innovation</a></li>
						<!-- <li><a href="measurement.php">Measurement of success</a></li> -->
						<li><a href="who_are_we.php">Who are we</a></li>
						<li><a href="engagement_cycle.php">Engagement cycle</a></li>
						<li><a href="social_industrial_advantages.php">Social and Industrial advantages</a></li>
					</ul>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 mobile">
					<h3>Derivatives</h3>
					<ul>
						<li><a href="derivates.php#presenter">Presenter</a></li>
						<li><a href="derivates.php#designer">Designer</a></li>
						<li><a href="derivates.php#technologist">Technologist</a></li>
						<li><a href="derivates.php#entrepreneur">Entrepreneur</a></li>
						<li><a href="derivates.php#innovator">Innovator - [IPR]  </a></li>
                        <li><a href="derivates.php#inclusive">Emergence of an Inclusive model </a></li>						
					</ul>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 mobile">
					<h3>Home Links</h3>
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="aboutus.php">About us</a></li>
						<li><a href="whyus.php">Why Us</a></li>
						<li><a href="advantage.php">Advantages</a></li>
						<li><a href="how_we_work.php">How We Work</a></li>
						<li><a href="derivates.php">Derivatives</a></li>
						<li><a href="contactus.php">Contact us</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="footer_bottom">
		<div class="row">
			<div class="col-md-12">
				<p>&copy; 2016 LIT Academy. All Rights Reserved.</p>
			</div>
		</div>
	</div>
</footer>




<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.superscrollorama.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="js/singlePageNav.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">
  $(window).load(function() {
    if ($('#slider').length > 0){
      $('#slider').nivoSlider({
      	manualAdvance:true,
      	afterLoad:function(){
      		var banH = $('#slider-panel').height();
      		if($(window).scrollTop() < banH){
      			$('.navbar-nav>li').first().find('a').addClass('active').end().siblings().find('a').removeClass('active');
      		}
      	}
      });
      }

	$('#status').delay(2000).fadeOut(); // will first fade out the loading animation
	$('#preloader').delay(2000).fadeOut('slow'); // will fade out the white DIV that covers the website.
  });
</script>
</body>
</html>