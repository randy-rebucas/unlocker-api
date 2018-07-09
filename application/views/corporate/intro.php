<!-- BEGIN REVOLUTION SLIDER -->    
       <?php if($this->config->item('slider')){   

                        echo $this->config->item('slider');

                    } ?>
        <!-- END REVOLUTION SLIDER -->
		
        <!-- BEGIN CONTAINER -->   
        <div class="container">
            <!-- BEGIN SERVICE BOX -->   

                    <?php if($this->config->item('after_slider')){   

                        echo $this->config->item('after_slider');

                    } ?>
                
            <!-- END SERVICE BOX -->  

			<!-- BEGIN BLOCKQUOTE BLOCK -->   
			<div class="row quote-v1 margin-bottom-30">
			  <div class="col-md-9">
				<span><?php echo $this->config->item('business_name');?> - Multi level GSM On-line Unlocking Service</span>
			  </div>
			  <div class="col-md-3 text-right">
				<a class="btn-transparent" href="<?php echo site_url('auth/login');?>"><i class="fa fa-lock margin-right-10"></i>Login</a>
			  </div>
			</div>
			<!-- END BLOCKQUOTE BLOCK -->
			
			<!-- BEGIN TABS AND TESTIMONIALS -->
        <div class="row mix-block margin-bottom-40">
          <!-- TABS -->
          <div class="col-md-7 tab-style-1">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-1" data-toggle="tab">Multipurpose</a></li>
              <li><a href="#tab-2" data-toggle="tab">Documented</a></li>
              <li><a href="#tab-3" data-toggle="tab">Responsive</a></li>
              <li><a href="#tab-4" data-toggle="tab">Clean & Fresh</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane row fade in active" id="tab-1">
                <div class="col-md-3 col-sm-3">
                  <a href="<?php echo base_url();?>themes/corporate/temp/photos/img7.jpg" class="fancybox-button" title="Image Title" data-rel="fancybox-button">
                    <img class="img-responsive" src="<?php echo base_url();?>themes/corporate/img/photos/img7.jpg" alt="">
                  </a>
                </div>
                <div class="col-md-9 col-sm-9">
                  <p class="margin-bottom-10">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Cosby sweater eu banh mi, qui irure terry richardson ex squid Aliquip placeat salvia cillum iphone.</p>
                  <p><a class="more" href="javascript:;">Read more <i class="icon-angle-right"></i></a></p>
                </div>
              </div>
              <div class="tab-pane row fade" id="tab-2">
                <div class="col-md-9 col-sm-9">
                  <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia..</p>
                </div>
                <div class="col-md-3 col-sm-3">
                  <a href="<?php echo base_url();?>themes/corporate/temp/photos/img10.jpg" class="fancybox-button" title="Image Title" data-rel="fancybox-button">
                    <img class="img-responsive" src="<?php echo base_url();?>themes/corporate/img/photos/img10.jpg" alt="">
                  </a>
                </div>
              </div>
              <div class="tab-pane fade" id="tab-3">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
              </div>
              <div class="tab-pane fade" id="tab-4">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
              </div>
            </div>
          </div>
          <!-- END TABS -->
        
          <!-- TESTIMONIALS -->
          <div class="col-md-5 testimonials-v1">
            <div id="myCarousel" class="carousel slide">
              <!-- Carousel items -->
              <div class="carousel-inner">
                <div class="active item">
                  <blockquote><p>Denim you probably haven't heard of. Lorem ipsum dolor met consectetur adipisicing sit amet, consectetur adipisicing elit, of them jean shorts sed magna aliqua. Lorem ipsum dolor met.</p></blockquote>
                  <div class="carousel-info">
                    <img class="pull-left" src="<?php echo base_url();?>themes/corporate/img/people/img1-small.jpg" alt="">
                    <div class="pull-left">
                      <span class="testimonials-name">Lina Mars</span>
                      <span class="testimonials-post">Commercial Director</span>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <blockquote><p>Raw denim you Mustache cliche tempor, williamsburg carles vegan helvetica probably haven't heard of them jean shorts austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.</p></blockquote>
                  <div class="carousel-info">
                    <img class="pull-left" src="<?php echo base_url();?>themes/corporate/img/people/img5-small.jpg" alt="">
                    <div class="pull-left">
                      <span class="testimonials-name">Kate Ford</span>
                      <span class="testimonials-post">Commercial Director</span>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <blockquote><p>Reprehenderit butcher stache cliche tempor, williamsburg carles vegan helvetica.retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid Aliquip placeat salvia cillum iphone.</p></blockquote>
                  <div class="carousel-info">
                    <img class="pull-left" src="<?php echo base_url();?>themes/corporate/img/people/img2-small.jpg" alt="">
                    <div class="pull-left">
                      <span class="testimonials-name">Jake Witson</span>
                      <span class="testimonials-post">Commercial Director</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Carousel nav -->
              <a class="left-btn" href="#myCarousel" data-slide="prev"></a>
              <a class="right-btn" href="#myCarousel" data-slide="next"></a>
            </div>
          </div>
          <!-- END TESTIMONIALS -->
        </div>                
        <!-- END TABS AND TESTIMONIALS -->
		<!-- BEGIN STEPS -->

		<div class="row no-space-steps margin-bottom-40">
			<div class="col-md-4 col-sm-4">
				<div class="front-steps front-step-one">
					<h2>Select Services</h2>
					<p>Lorem ipsum dolor sit amet sit consectetur adipisicing eiusmod tempor.</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="front-steps front-step-two">
					<h2>Place order</h2>
              <p>Lorem ipsum dolor sit amet sit consectetur adipisicing eiusmod tempor.</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="front-steps front-step-three">
					<h2>Unlock</h2>
              <p>Lorem ipsum dolor sit amet sit consectetur adipisicing eiusmod tempor.</p>
				</div>
			</div>
		</div>
			
        <!-- END STEPS -->
		<!-- BEGIN CLIENTS -->
            <div class="row margin-bottom-40 our-clients">
                <div class="col-md-3">
                    <h2><a href="#">Our Clients</a></h2>
                    <p>Lorem dipsum folor margade sitede lametep eiusmod psumquis dolore.</p>
                </div>
                <div class="col-md-9">
                    <ul class="bxslider1 clients-list">
                        <li>
                            <a href="#">
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_1_gray.png" alt="" /> 
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_1.png" class="color-img" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_2_gray.png" alt="" /> 
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_2.png" class="color-img" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_3_gray.png" alt="" /> 
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_3.png" class="color-img" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_4_gray.png" alt="" /> 
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_4.png" class="color-img" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_5_gray.png" alt="" /> 
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_5.png" class="color-img" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="#">                        
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_6_gray.png" alt="" /> 
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_6.png" class="color-img" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_7_gray.png" alt="" /> 
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_7.png" class="color-img" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="#">                        
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_8_gray.png" alt="" /> 
                                <img src="<?php echo base_url();?>themes/corporate/img/clients/client_8.png" class="color-img" alt="" />
                            </a>
                        </li>
                    </ul>                        
                </div>
            </div>
            <!-- END CLIENTS -->
        </div>
        <!-- END CONTAINER -->