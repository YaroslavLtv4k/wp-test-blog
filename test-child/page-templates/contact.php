<?php /* Template name: Контакты */ ?>

<?php get_header() ?>

<section id="contact" class="contact_bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section_heading section_heading_2">
					<h2> Contact Us </h2>
				
					<h4>Let drop a line to us & we will be in touch soon. Here goes some simple dummy text. Lorem Ipsum is simply dummy text </h4>
				</div>
							
				<div class="col-md-6">
					<div class="contact_form">
					<form>
					  <div class="form-group">
						<label >Full Name : <span> *</span></label>
						<input type="email" class="form-control" id="exampleInputEmail1" >
					  </div>
					  
					  <div class="form-group">
						<label >Email Address : <span> *</span></label>
						<input type="text" class="form-control" id="exampleInputPassword1" >
					  </div>
					  
					  <div class="form-group">
						<label>Message <span> *</span></label>
						<textarea class="form-textarea" rows="3"></textarea>
					 </div>
					  
					    <div class="section_sub_btn">
							<button class="btn btn-default" type="submit">  Send Message</button>	
						</div>
					</form> 
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="contact_text">
						<ul>
							<li>
								<span><i class="fa fa-home" aria-hidden="true"></i></span> 
								<h5> 1234 Street Name, City Name, United States</h5>
							</li>
							
							<li>
								<span><i class="fa fa-envelope-o" aria-hidden="true"></i></span> 
								<h5> contact@domain.com </h5>
							</li>
							
							<li>
								<span><i class="fa fa-phone" aria-hidden="true"></i></span> 
								<h5> (123) 123-45678 </h5>
							</li>
							
							<li>
								<span><i class="fa fa-fax" aria-hidden="true"></i></span> 
								<h5> (123) 123-45678 </h5>
							</li>
						</ul>
						
					</div>
				</div>
				
				
			</div>
		</div>
	</div>
</section>

<?php get_footer() ?>
