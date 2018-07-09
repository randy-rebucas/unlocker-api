
<style>
a.btn.btn-primary i {
    position: relative;
    left: -24px;
    display: inline-block;
    padding: 7px 10px;
    background: rgba(0,0,0,.15);
    border-radius: 3px 0 0 3px;
}
</style>
<?php
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
?>
<!-- MAIN CONTENT -->
<div id="content" class="container">

	<div class="row">

		<div class="col-sm-6 col-md-offset-3">
			<div class="well no-padding">

				<?php echo form_open($this->uri->uri_string(), 'id="send-again" class="smart-form client-form"'); ?>
					<header>
						Send Activation Link
					</header>

					<fieldset>
						
						<section>
							<label class="label"><?php echo $this->lang->line('__email');?></label>
							<label class="input"> <i class="icon-append fa fa-user"></i>
							<?php echo form_input($email); ?>
								<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> <?php echo $this->lang->line('__enter_email_username');?></b></label>
						</section>

						
					</fieldset>
					<footer>
						<!-- <a href="<?php //echo $loginUrl;?>" class="btn btn-primary hidden"> <i class="fa fa-facebook"></i> Register </a> -->

						<button type="submit" id="submit" class="btn btn-primary">
							Send
						</button>
							
					</footer>
				</form>
				
			</div>
			
		</div>
	</div>
</div>

<script type="text/javascript">

	runAllForms();

	$(function() {
		$("#login-form input:first").focus();
		// Validation
		$("#send-again-form").validate({
			// Rules for form validation
			rules : {
				email : {
					required : true,
					email : true
				}
			},
			// Messages for form validation
			messages : {
				email : {
					required : '<i class="fa fa-exclamation-circle"></i> <?php echo sprintf($this->lang->line('__validate_required'), 'email');?>',
					email : '<i class="fa fa-exclamation-circle"></i> <?php echo $this->lang->line('__validate_email');?>'
				}
			},

			highlight: function(element) {
				$(element).closest('.form-group').addClass('has-error');
			},
			unhighlight: function(element) {
				$(element).closest('.form-group').removeClass('has-error');
			},
			errorElement: 'span',
			errorClass: 'text-danger',
			errorPlacement: function(error, element) {
				if(element.parent('.input-group').length) {
					error.insertAfter(element.parent());
				}else{
					error.insertAfter(element);
				}
			},
			// Ajax form submition
			submitHandler : function(form) {
				
				$(form).ajaxSubmit({
					beforeSend: function () {
						$('#submit').html('<?php echo $this->lang->line('__common_please_wait');?>');
						$('#submit').attr("disabled", "disabled");
					},
					success:function(response)
					{
						console.log(response);
						if(response.success)
						{
							$.smallBox({
								title : "Success",
								content : response.message,
								color : "#739E73",
								iconSmall : "fa fa-check",
								timeout : 3000
							});
							$('#submit').html('<?php echo $this->lang->line('__common_redirecting');?>');
							setTimeout(function () {
								window.location.href = BASE_URL+'dashboard/';
							}, 5000);
						}
						else
						{
							var res = [];
							$.each( response.message, function( key, value ) {
								console.log( key + ": " + value );
								res = value;
							});
							$.smallBox({
								title : "Error",
								content : res,
								color : "#C46A69",
								iconSmall : "fa fa-warning shake animated",
								timeout : 3000
							});
							$('#submit').text('<?php echo $this->lang->line('__common_submit');?>');
							$('#submit').removeAttr("disabled");
						}                   
						
					},
					dataType:'json'
				});
			}
		});
	});
</script>