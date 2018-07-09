
		<div class="row breadcrumbs">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>Testimonial</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="active">Testimonial</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
        <!-- BEGIN CONTAINER -->   
		<div class="container min-hight">
			<div class="row">
				<div class="col-md-9 col-sm-9">
					<?php if ($result->num_rows() > 0 ) {
						foreach ($result->result() as $row) { 
							$uInfo = $this->users->get_info($row->user_id);?>
							<blockquote class="<?php echo alternator('', 'pull-right'); ?>">
								<p><?php echo $row->testimonial_messasge;?></p>
								<small>Author: <cite title="Source Title"><?php echo $uInfo->username;?></cite> [ <?php echo $row->testimonial_created;?> ]</small>
							</blockquote>
						<?php }
					} else {
						echo '<div class="well">
								<h4>Sorry</h4>
								No data found!
							</div>';
					} ?>
					
					

				</div>
				<div class="col-md-3 col-sm-3">

				</div>
			</div>
		</div>						

								