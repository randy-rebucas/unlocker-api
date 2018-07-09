
<div class="page-content">

<div class="portlet box green ">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i> <?php echo $title;?>
		</div>
		
	</div>
	<div class="portlet-body form">
		<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal" id="" role="form"');?>
			<div class="form-body">
				<?php if ($this->session->flashdata('alert_success')) { ?>
			    <div class="alert alert-success">
			        <?php echo $this->session->flashdata('alert_success'); ?>
			        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    </div>
			    <?php } ?>
				<?php echo form_error('message', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-3 control-label">Types</label>
					<div class="col-md-9">	
						<input type="text" class="form-control" name="subject" value="<?php echo $notification_info->subject;?>"/>
						
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Short message(reference)</label>
					<div class="col-md-9">
						<textarea name="message" data-provide="markdown" data-autofocus="true" class=" form-control" rows="6"><?php echo $notification_info->content;?></textarea>
					</div>
				</div>
				
			</div>
			<div class="form-actions fluid">
				<div class="col-md-offset-3 col-md-9">
					<button type="button" onclick="goBack()" class="btn default">Back</button>
					<button type="submit" class="btn green">Submit</button>
					
				</div>
			</div>
		<?php echo form_close();?>
	</div>
</div>

</div>