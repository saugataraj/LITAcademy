<?php
  $pageTitle = 'LIT Academy'; 
  $page ="home";
	include('header.php');
?>

<script type="text/javascript">

function formCheck(form){
 var letters = /^[A-Za-z\s]+$/;  
  var phoneno = /^[\d -]+$/gm;
  var email = /.+\@.+\..+/;

  //NAME
  if( form.name.value == "" || form.name.value.trim().length == 0 ){ alert( "Please Enter Your Name" ); form.name.focus(); return false; 
  }else if(!form.name.value.match(letters)){  alert("Please Enter Your Name Correctly"); form.name.focus(); return false; }

  //EMAIL
  if( form.email.value == "" || form.email.value.trim().length == 0 ){ alert( "Please Enter Your Email ID" ); form.email.focus(); return false; 
  }else if(!form.email.value.match(email)){  alert("Please Enter Your Email ID Correctly"); form.email.focus(); return false; }

  //PHONE
  if( form.mobile.value == "" ) { alert( "Please Enter Your Phone Number" ); form.mobile.focus(); return false;
  }else if(!form.mobile.value.match(phoneno)){  alert("Please Enter Your Phone Number Correctly"); form.mobile.focus(); return false; }

  if( form.subject.value == "" || form.subject.value.trim().length == 0 ){ alert( "Please Enter Your Message" ); form.subject.focus(); return false; 
  }
}

</script>

<section>
  <div class="container-fluid" id="banner">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">           
        <div id="slider-panel" class="fixed_margin">
          <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <img src="img/banner.jpg" title="#sli-cap-1" data-transition="fade" class="img-responsive" />
            </div>
          </div>
          <div class="hidden-xs hidden-sm hidden-md hidden-lg" id="sli-cap-1" >
	         <div class="sli_cap_1">
	           <h6>Let's</h6> <h5>Innovate</h5>  <span>Together, a Togetherness</span>
	         </div>	          
          </div>                 
        </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</section>

<section>
	<div class="container-fluid" id="aboutUs">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h1><strong>A</strong>Bout us</h1>
					<h2><span>Introducing </span>innovation</h2>
					<p>"Innovation is a new idea, more effective device or process. Innovation can be viewed as the application of better solutions that meet new requirements, unarticulated needs, or existing market needs. This is accomplished through more effective products, processes, services, technologies, or ideas that are readily available to markets, governments and society. The term innovation can be defined as something original and more effective and, as a consequence, new, that "breaks into" the market or society."</p>

					<p>While a novel device is often described as an innovation, in economics, management science, and other fields of practice and analysis, innovation is generally considered to be a process that brings together various novel ideas in a way that they have an impact on society.</p>
					<div class="aboutAtn"><a href="aboutus.php" class="viewMore hvr-overline-from-center">VIEW MORE</a><a href="aboutus.php#aboutlab" class="innovation hvr-overline-from-center">What is Innovation Lab</a>
				</div>
			</div>
		</div>
	</div>
    </div>
  <div class="clear"></div>
</section>

<section>
  <div class="container-fluid" id="whyUs">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12  col-sm-offset-6 col-md-offset-8">
          <div class="centerPosition">
            <h1><strong>W</strong>hy us</h1>
            <h2>Imparting knowledge<br/><span>to Develop skilled indiviDuals</span></h2>
            <p>In general, we see problem as a problem, and not as an opportunity to innovate a solution. If the necessity is the mother of invention, it is important to identify, analyse and articulate the necessity</p>          
            <div class="whyus"><a href="whyus.php"><img src="img/whyus.png"></a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</section>

<section>
  <div class="container-fluid" id="advantage">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12">
            <h1><strong>A</strong>dvantage</h1>
            <p>The institution cultivates a great value of innovation by early induction of the student on to it. It helps to build the relevance of the 
            subject maters and its applicabilities. It also bring a purpose to the whole process. While we see a great value creation by the whole process, we need to understand that for each stakeholder discretely. </p>                      
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <a href="advantage.php#students" class="advanTage">
            <div class="advImg">
              <img src="img/adv-1.png">
            </div>          
            <div class="advTitle">
              Students
            </div>
          </a>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <a href="advantage.php#faculty" class="advanTage">
            <div class="advImg">
              <img src="img/adv-2.png">
            </div>
            <div class="advTitle">
              Faculty members
            </div>
          </a>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <a href="advantage.php#institution" class="advanTage">
            <div class="advImg">
              <img src="img/adv-3.png">
            </div>
            <div class="advTitle">
              Institution / college
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</section>

<section>
  <div class="container-fluid" id="howWeWork">    
    <div class="row">
      <div class="col-md-5 col-xs-12 col-sm-4"></div>
      <div class="col-md-7 col-xs-12 col-sm-8 bluebg">
        <div class="bluebgdiv">
          <h1><strong>H</strong>ow we work</h1>
          <p>The Innovation lab adopt the inclusive model of operation and help to 
          democratise the knowledge towards its applicability.  It helps to create product and solutions and help to bring the imagination of individuals and team in a realm. Here the detail on how it operates.  </p>  
          <div class="howWork"><a href="how_we_work.php" class="hvr-overline-from-center">Read More</a></div> 
        </div>                   
      </div>
    </div>    
  </div>  
  <div class="clear"></div>
</section>

<section>
  <div class="container-fluid" id="derivatives">    
    <div class="container">
      <div class="row">
        <div class="col-md-5 col-offset-md-7 col-xs-12 col-sm-8">
            <h1>Derivatives</h1>
            <p>The right derivative of any innovation is a solution of technology excellence, which solve a prevailing challenge and/or create a disruptive opportunity.</p> 
            <ul class="listAlpha">
              <li>Intellectual Property Right</li>
              <li>Entrepreneurship</li>
              <li>Free and Open Source Software</li>
              <li>Designer</li>
              <li>Presenter</li>
            </ul>                               
        </div>
      </div> 
    </div>   
  </div>  
  <div class="clear"></div>
</section>

<section>
  <div class="container-fluid" id="newsletter">    
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">          
           <form action="#">
            <div class="input-group">
              <label>SUBSCRIBE & FOLLOW</label>
              <input class="btn btn-lg" name="email" id="email" type="email" placeholder="Enter Your Mail-id" required>
              <button class="btn btn-lg" type="submit">SUBSCRIBE</button>
            </div>
           </form>          
        </div>
      </div> 
    </div>   
  </div>
  <div class="clear"></div>
</section>

<section>
  <div class="container-fluid" id="contact">    
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12">
            <h1><strong>C</strong>ontact us</h1>

            <form onsubmit="return formCheck(this)" method="post" action="contactForm.php" class="form" role="form">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 form-group">
                  <input class="form-control" name="name" placeholder="Enter Your name " type="text"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 form-group">
                  <input class="form-control" name="email" placeholder="Enter Your Email id" type="email"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 form-group">
                  <input class="form-control" name="mobile" placeholder="Enter Your Mobile" type="text"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 form-group">
                  <input class="form-control" name="subject" placeholder="Enter Your Subject" type="text"/>
                </div>
                 <div class="col-md-12 col-xs-12 col-md-12 form-group">
                  <textarea class="form-control" name="message" placeholder="Type Your Message" rows="5"></textarea>
                </div>
                <div class="col-xs-12 col-md-12 form-group">
                  <button class="btn hvr-overline-from-center" type="submit">SUBMIT</button> 
                </div>
              </div>                                                  
            </form>   

        </div>
      </div> 
    </div>   
  </div>  
  <div class="clear"></div>
</section>

<section>
  <div class="container-fluid" id="map">
    <div class="row">
      <div class="col-md-12">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7774.774006825823!2d80.25210447440018!3d13.01100956332011!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5267eb7318fbc7%3A0x116cd50f17c5b328!2sGandhi+Nagar%2C+Adyar%2C+Chennai%2C+Tamil+Nadu+600020!5e0!3m2!1sen!2sin!4v1469510502563" width="100%" height="250" frameborder="0" style="border:0; display:block;" allowfullscreen>        
        </iframe>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</section>


<?php 
	include('footer.php');
?>

<script type="text/javascript">
  //SCROLLING ANIMATION SCRIPTS

  //SUPERSCROLLORAMA PLUGIN

  var controller = $.superscrollorama({ reverse : false });

/*ABOUT US*/

  controller.addTween('#aboutUs', TweenMax.from( $('#aboutUs h1'), 1.5, {delay:Math.random()*.5,css:{top:-150,opacity:0}, ease:Back.easeOut}));

  controller.addTween('#aboutUs', TweenMax.from( $('#aboutUs h2'), 1.5, {delay:Math.random()*.3,css:{left:150,opacity:0}, ease:Back.easeOut}));

  controller.addTween('#aboutUs', TweenMax.from( $('#aboutUs p'), 1.5, {delay:Math.random()*.3,css:{right:150,opacity:0}, ease:Back.easeOut}));

  controller.addTween('#aboutUs', TweenMax.from( $('#aboutUs .aboutAtn'), 1.5, {delay:Math.random()*.3,css:{bottom:-150,opacity:0}, ease:Back.easeOut}));

/*ABOUT US*/

/*WHY US*/

  controller.addTween('#whyUs', TweenMax.from( $('#whyUs h1'), 1.5, {delay:Math.random()*.5,css:{top:-150,opacity:0}, ease:Back.easeOut}));

  controller.addTween('#whyUs', TweenMax.from( $('#whyUs h2'), 1.5, {delay:Math.random()*.3,css:{left:150,opacity:0}, ease:Back.easeOut}));

  controller.addTween('#whyUs', TweenMax.from( $('#whyUs p'), 1.5, {delay:Math.random()*.3,css:{left:150,opacity:0}, ease:Back.easeOut}));

  controller.addTween('#whyUs', TweenMax.from( $('#whyUs .whyus'), 1.5, {delay:Math.random()*.3,css:{bottom:-150,opacity:0}, ease:Back.easeOut}));

/*WHY US*/

/*ADVANTAGE*/

  controller.addTween('#advantage', TweenMax.from( $('#advantage .col-md-12 h1'), 1.5, {delay:Math.random()*.5,css:{top:-150,opacity:0}, ease:Back.easeOut}));

  controller.addTween('#advantage', TweenMax.from( $('#advantage .col-md-12 p'), 1.5, {delay:Math.random()*.5,css:{top:-150,opacity:0}, ease:Back.easeOut}));

  var advDelay = .5;

    $('#advantage .container .row > .col-md-4').each(function() {

        controller.addTween('#advantage', 

          TweenMax.from( $(this),  1.5, {delay:advDelay,css:{top:150,opacity:0}, ease:Back.easeOut}));

      advDelay+=.3;

    });

/*ADVANTAGE*/


/*HOW WE WORK*/

  controller.addTween('#howWeWork', TweenMax.from( $('#howWeWork .bluebgdiv h1'), 1.5, {delay:Math.random()*.3,css:{top:-250,opacity:0}, ease:Back.easeOut}));

  controller.addTween('#howWeWork', TweenMax.from( $('#howWeWork .bluebgdiv p'), 1.5, {delay:Math.random()*.4,css:{right:-200,opacity:0}, ease:Back.easeOut}));

  controller.addTween('#howWeWork', TweenMax.from( $('#howWeWork .bluebgdiv .howWork'), 1.5, {delay:Math.random()*.3,css:{bottom:-250,opacity:0}, ease:Back.easeOut}));

/*HOW WE WORK*/

/*DERIVATIVES*/

  controller.addTween('#derivatives', TweenMax.from( $('#derivatives  h1'), 1.5, {delay:Math.random()*.3,css:{top:-250,opacity:0}, ease:Back.easeOut}));

  controller.addTween('#derivatives', TweenMax.from( $('#derivatives  p'), 1.5, {delay:Math.random()*.4,css:{right:-200,opacity:0}, ease:Back.easeOut}));

  var derDelay = .5;

    $('#derivatives .listAlpha > li').each(function() {

        controller.addTween('#derivatives', 

          TweenMax.from( $(this),  1.5, {delay:derDelay,css:{top:100,opacity:0}, ease:Back.easeOut}));

      derDelay+=.3;

    });

  
/*DERIVATIVES*/


/*CONTACT*/

 controller.addTween('#contact', TweenMax.from( $('#contact h1'), 1.5, {delay:Math.random()*.5,css:{top:-200,opacity:0}, ease:Back.easeOut}));

 /*controller.addTween('#contact', TweenMax.from( $('#contact .form-group'), 1.5, {delay:Math.random()*.5,css:{right:-150,opacity:0}, ease:Back.easeOut}));*/

 var derDelay = .5;

    $('#contact .form-group').each(function() {

        controller.addTween('#contact', 

          TweenMax.from( $(this),  1.5, {delay:derDelay,css:{top:100,opacity:0}, ease:Back.easeOut}));

      derDelay+=.3;

    });

/*CONTACT*/


/*COMMON-TITLE*/

  controller.addTween('#map', TweenMax.from( $('#inner_footer h4'), 1.5, {delay:Math.random()*.5,css:{right:-150,opacity:0}, ease:Back.easeOut}));

  controller.addTween('#map', TweenMax.from( $('#inner_footer p'), 1.5, {delay:Math.random()*.5,css:{left:-150,opacity:0}, ease:Back.easeOut}));

/*COMMON-TITLE*/
</script>