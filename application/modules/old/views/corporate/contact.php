
<!-- BEGIN BREADCRUMBS -->   
        <div class="row breadcrumbs">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>Contact</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="active">Contact</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->

		<!-- BEGIN GOOGLE MAP -->
		<div class="row">
			<div id="map" class="gmaps margin-bottom-40" style="height:400px;"></div>
		</div>
		<!-- END GOOGLE MAP -->

		<!-- BEGIN CONTAINER -->   
		<div class="container min-hight">
			<div class="row">
				<div class="col-md-9 col-sm-9">
					<h2>Contact Form</h2>
					
					<div class="space20"></div>
					<!-- BEGIN FORM-->
					<form action="#" class="horizontal-form margin-bottom-40" role="form">
						<div class="form-group">
							<label class="control-label">Name</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label" >Email <span class="color-red">*</span></label>
							<div class="col-lg-12">
								<input type="text" class="form-control" >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label" >Message</label>
							<div class="col-lg-12">
								<textarea class="form-control" rows="8"></textarea>
							</div>
						</div>
						<button type="submit" class="btn btn-default theme-btn"><i class="icon-ok"></i> Send</button>
						<button type="button" class="btn btn-default">Cancel</button>
					</form>
					<!-- END FORM-->                  
				</div>

				<div class="col-md-3 col-sm-3">
					<h2>Our Contacts</h2>
					 <address class="margin-bottom-40">
                        <?php echo $this->config->item('business_name');?> <br />
                        <?php echo $this->config->item('address1');?><br />
                        <?php echo $this->config->item('address2');?><br />
                        <?php echo $this->config->item('city');?>, <?php echo $this->config->item('state');?> <br />
                        <?php echo $this->config->item('country');?>, <?php echo $this->config->item('postal_code');?> <br />
                        P: <?php echo $this->config->item('contact_number');?> <br />                   
                    </address>
					<address>
						<strong>Email</strong><br>
						<a href="mailto:<?php echo $this->config->item('email');?>"><?php echo $this->config->item('email');?></a>  
					</address>
					<ul class="social-icons margin-bottom-10">
						<?php if($this->config->item('facebook')){   ?>
                            <li><a href="<?php echo $this->config->item('facebook');?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <?php } ?>
                        <?php if($this->config->item('google_plus')){   ?>
                            <li><a href="<?php echo $this->config->item('google_plus');?>" target="_blank"><i class="fa google-plus"></i></a></li>
                        <?php } ?>
                        <?php if($this->config->item('twitter')){   ?>
                            <li><a href="<?php echo $this->config->item('twitter');?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <?php } ?>
                        <?php if($this->config->item('skype')){   ?>
                            <li><a href="<?php echo $this->config->item('skype');?>" target="_blank"><i class="fa fa-skype"></i></a></li>
                        <?php } ?>
                        <?php if($this->config->item('youtube')){   ?>
                            <li><a href="<?php echo $this->config->item('youtube');?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        <?php } ?>
					</ul>

					                    
				</div>            
			</div>
		</div>
		<!-- END CONTAINER -->