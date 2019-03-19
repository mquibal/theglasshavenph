<?php require_once "../partials/template.php" ?>
<?php function get_page_content() { 
    global $conn;?>


<div class="top">
  <div class="top_image">   
       <h1 class="top_content">Contact</h1>
    </div>  
</div>

   	
	<div class="container">
		<div class="row">
			<div class="col-lg-1"></div>
			<div class="col-lg-5 mt-5">

				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30890.059283120347!2d121.02099562577624!3d14.584402848003775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c835c77b9b79%3A0xdc4947c8b9d237f8!2sMandaluyong%2C+Metro+Manila!5e0!3m2!1sen!2sph!4v1546351572168" width="350" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>

			</div>
			<div class="col-lg-5 mt-5 mb-5">

				<form class="contact_form">
				
					<h4><span>Send us your message</span></h4>

					<div class="form-group mb-3">
				
					<input type="text" class="form-control" id="username" name="username" placeholder="Full Name">
					</div>

					
					<div class="form-group">
					<input type="password" class="form-control" id="password" name="password" placeholder="Phone Number">	
					</div>

					<div class="form-group">
					<input type="password" class="form-control" id="password" name="password" placeholder="Email Add">	
					</div>

					<div class="form-group">
					<input type="password" class="form-control" id="password" name="password" placeholder="Message">	
					</div>

					<div class="form-group" id="btn-login">
					<button type="button" class="btn_validation" id="login">Send</button>
					</div>


				</form>		
			</div>
		<div class="col-lg-1"></div>	
	</div>			
</div>						
				

<?php } ?>  
