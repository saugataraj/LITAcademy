<?php
  $pageTitle = 'Contact us | LIT Academy';
  $currentPage = 'contactus'; /*current page is about, do the same for other page*/ 
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
  <div class="container-fluid innerbanners">
    <div class="row">
      <div class="col-md-12">
        <img src="img/contact_bg.jpg">
      </div>
    </div>
  </div>
</section>
<section>
	<div class="container-fluid" id="aboutUsInner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h1><strong>C</strong>ontact us</h1>
					<h2>get<span> In touch</span></h2> 
					  <form onsubmit="return formCheck(this)" method="post" action="contactForm.php" class="form" role="form">
              <div class="row">
                <div class="col-xs-12 col-md-6 form-group">
                  <input class="form-control" name="name" placeholder="Enter Your name " type="text"/>
                </div>
                <div class="col-xs-12 col-md-6 form-group">
                  <input class="form-control" name="email" placeholder="Enter Your Email id" type="email"/>
                </div>
                <div class="col-xs-12 col-md-6 form-group">
                  <input class="form-control" name="mobile" placeholder="Enter Your Mobile" type="text"/>
                </div>
                <div class="col-xs-12 col-md-6 form-group">
                  <input class="form-control" name="subject" placeholder="Enter Your Subject" type="text"/>
                </div>
                 <div class="col-md-12 col-xs-12 col-md-12 form-group">
                  <textarea class="form-control" name="message" placeholder="Type Your Message" rows="5"></textarea>
                </div>
                <div class="col-xs-12 col-md-12 form-group">
                  <button class="btn" type="submit">SUBMIT</button> 
                </div>
              </div>                                                  
            </form> 
  			</div>
  		</div>
  	</div>
  </div>
  <div class="container aboutinner">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <p>The Lab mainly focus on a real-life challenges, which may attract multi disciplinary approach. The prevailing college/institution are mainly focus around departmental facilities, focused on individual verticals. The Innovation Lab brings a convergence of technologies and enable to think and envisage cross-functional engineering to solve a problem. This is the amazing part of incubating the innovation Lab within the Institution facility and builds it as an integral part of the system. </p>
      </div>
    </div>
  </div>
</section>





<?php 
	include('footer.php');
?>