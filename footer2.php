<hr>
			<!-- FOOTER-3
			============================================= -->
			<footer id="footer-3" class="footer ft-3-ntr">
				<div class="container">


					<div class="row">


						<div class="col-md-2">
							<div class="footer-info">
								<img class="footer-logo" src="https://reapbucks.com/assets/images/reapbucks.png" alt="footer-logo">
							</div>	
						</div>	
	                   <div class="col-md-2 col-sm-4">
							<div class="footer-info1">
								<a href="https://reapbucks.com/about-us">About Us</a>
							</div>	
						</div>
                         <div class="col-md-2 col-sm-4">
							<div class="footer-info1">
								<a href="https://reapbucks.com/contact-us">Contact Us</a>
							</div>	
						</div>
						 <div class="col-md-2 col-sm-4">
							<div class="footer-info1">
								<a href="https://reapbucks.com/faqs">FAQs</a>
							</div>	
						</div>
						 <div class="col-md-2 col-sm-4">
							<div class="footer-info1">
								<a href="https://reapbucks.com/blogs">Blogs</a>
							</div>	
						</div>
						 <div class="col-md-2 col-sm-4">
							<div class="footer-info1">
								<a href="https://reapbucks.com/userpanel/">Sign Up</a>
							</div>	
						</div>

					</div>	

					<!-- BOTTOM FOOTER -->
					<div class="bottom-footer">
						<div class="row row-cols-1 row-cols-md-2 d-flex align-items-center">


							<!-- FOOTER COPYRIGHT -->
							<div class="col">
								<div class="footer-copyright">
									<p class="p-sm">&copy; 2017 Reapbucks. <span>All Rights Reserved</span></p>
								</div>
							</div>


							<!-- FOOTER SOCIALS -->
							<div class="col">
								<ul class="bottom-footer-socials ico-20 text-end">
									<li><a href="#"><span class="fa fa-facebook"></span></a></li>
									<li><a href="#"><span class="fa fa-linkedin"></span></a></li>
									<li><a href="#"><span class="fa fa-instagram"></span></a></li>
								</ul>
							</div>


						</div>  <!-- End row -->
					</div>	<!-- END BOTTOM FOOTER -->


				</div>     <!-- End container -->	
			</footer>   <!-- END FOOTER-3 -->	
			



		</div>	<!-- END PAGE CONTENT -->	


<style>
    .footer-info1{
        /*text-align:center;*/
    }
</style>

		<!-- EXTERNAL SCRIPTS
		============================================= -->	
		<script src="https://reapbucks.com/js2/jquery-3.7.0.min.js"></script>
		<script src="https://reapbucks.com/js2/bootstrap.min.js"></script>	
		<script src="https://reapbucks.com/js2/modernizr.custom.js"></script>
		<script src="https://reapbucks.com/js2/jquery.easing.js"></script>
		<script src="https://reapbucks.com/js2/jquery.appear.js"></script>
		<script src="https://reapbucks.com/js2/menu.js"></script>
		<script src="https://reapbucks.com/js2/owl.carousel.min.js"></script>
		<script src="https://reapbucks.com/js2/pricing-toggle.js"></script>
		<script src="https://reapbucks.com/js2/jquery.magnific-popup.min.js"></script>
		<script src="https://reapbucks.com/js2/request-form.js"></script>	
		<script src="https://reapbucks.com/js2/jquery.validate.min.js"></script>
		<script src="https://reapbucks.com/js2/jquery.ajaxchimp.min.js"></script>	
		<script src="https://reapbucks.com/js2/popper.min.js"></script>
		<script src="https://reapbucks.com/js2/lunar.js"></script>
		<script src="https://reapbucks.com/js2/wow.js"></script>
				
		<!-- Custom Script -->		
		<script src="https://reapbucks.com/js2/custom.js"></script>

		<script src="https://reapbucks.com/js2/changer.js"></script>
		<script defer src="https://reapbucks.com/js2/styleswitch.js"></script>	
        
        <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>


        <script>
              const firebaseConfig = {
                apiKey: "AIzaSyCKuCRd4g1cpK0JUpE4LiZEBAruuPEslSU",
                authDomain: "reapbucks-app-rewords.firebaseapp.com",
                projectId: "reapbucks-app-rewords",
                storageBucket: "reapbucks-app-rewords.firebasestorage.app",
                messagingSenderId: "49877699544",
                appId: "1:49877699544:web:6159119cbabca8b7b040ad",
                measurementId: "G-D1TKN2TEGG"
              };
                firebase.initializeApp(firebaseConfig);
                const messaging=firebase.messaging();
            
                function IntitalizeFireBaseMessaging() {
                    messaging
                        .requestPermission()
                        .then(function () {
                            //console.log("Notification Permission");
                            return messaging.getToken();
                        })
                        .then(function (token) {
                            //console.log("Token : "+token);
                            //document.getElementById("token").innerHTML=token;
                            $.ajax({  
                            type: "POST",  
                            url: "firebase_token_store.php", 
                            data: "token="+ token,
                            success: function(response) {
                                
                            }
                        });
                        })
                        .catch(function (reason) {
                            //console.log(reason);
                        });
                }
            
                messaging.onMessage(function (payload) {
                    //console.log(payload);
                    const notificationOption={
                        body:payload.notification.body,
                        icon:payload.notification.icon
                    };
            
                    if(Notification.permission==="granted"){
                        var notification=new Notification(payload.notification.title,notificationOption);
            
                        notification.onclick=function (ev) {
                            ev.preventDefault();
                            window.open(payload.notification.click_action,'_blank');
                            notification.close();
                        }
                    }
            
                });
                messaging.onTokenRefresh(function () {
                    messaging.getToken()
                        .then(function (newtoken) {
                            console.log("New Token : "+ newtoken);
                        })
                        .catch(function (reason) {
                            //console.log(reason);
            				//alert(reason);
                        })
                })
                IntitalizeFireBaseMessaging();
</script>
	</body>
</html>