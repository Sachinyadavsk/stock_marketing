<?php require('header.php');?>
			<!-- CONTACTS-1
			============================================= -->
			<section id="contacts-1" class="pb-50 inner-page-hero contacts-section division">				
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row justify-content-center">	
						<div class="col-md-10 col-lg-9">
							<div class="section-title text-center mb-80">	

								<!-- Title -->	
								<h2 class="s-52 w-700">Any Questions? Let's Talk</h2>	
								<p>To get any information, connect with us at <b>info@reapbucks.com</b></p>	
							</div>	
						</div>
					</div>


					<!-- CONTACT FORM -->
				 	<div class="row justify-content-center">	
				 		<div class="col-md-11 col-lg-10 col-xl-8">
				 			<div class="form-holder">
								<form name="contactform" class="row contact-form">

									<!-- Form Select -->
									<div class="col-md-12 input-subject">
										<p class="p-lg">This query is about: </p>
										<span>Choose a topic, so we know who to send your request to: </span>
										<select class="form-select subject" aria-label="Default select example">
									    	<option selected>This question is about...</option>	
											<option>Registering/Authorising</option>
											<option>Using Application</option>
											<option>Other</option>
											
									    </select>
									</div>
																						
									<!-- Contact Form Input -->
									<div class="col-md-12">
										<p class="p-lg">Your Name: </p>
										<span>Please enter your name: </span>
										<input type="text" name="name" class="form-control name" placeholder="Your Name*"> 
									</div>
												
									<div  class="col-md-12">
										<p class="p-lg">Your Email Address: </p>
										<span>Please carefully check your email address for accuracy</span>
										<input type="text" name="email" class="form-control email" placeholder="Email Address*"> 
									</div>
		
									<div class="col-md-12">
										<p class="p-lg">Explain your question in details: </p>
										<span>Be VERY precise!</span>
										<textarea class="form-control message" name="message" rows="6" placeholder="My question is..."></textarea>
									</div> 
																						
									<!-- Contact Form Button -->
									<div class="col-md-12 mt-15 form-btn text-right">	
										<button type="submit" class="btn btn--theme hover--theme submit">Submit Request</button>	
									</div>
																															
									<!-- Contact Form Message -->
									<div class="col-lg-12 contact-form-msg">
										<span class="loading"></span>
									</div>	
																							
								</form>	
				 			</div>	
				 		</div>	
				 	</div>	   <!-- END CONTACT FORM -->


				</div>	   <!-- End container -->	
			</section>	<!-- END CONTACTS-1 -->


			<!-- DIVIDER LINE -->
<?php require('footer2.php');?>