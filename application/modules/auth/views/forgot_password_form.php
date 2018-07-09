
<!-- MAIN CONTENT -->
	<div id="content" class="container">

		<div class="row">
			
			<div class="col-sm-6 col-md-offset-3">
				<div class="well no-padding">
					<?php echo form_open('auth/doForgot','id="login-form" class="smart-form client-form"'); ?>
						<header>
							<?php echo $this->lang->line('__forgot_password');?>
						</header>

						<fieldset>
							
							
							<section>
								<label class="label"><?php echo $this->lang->line('__forgot_password');?></label>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="email" name="email" id="email" value="<?php echo set_value('email');?>">
									<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> <?php echo $this->lang->line('__enter_email');?></b> </label>
								<div class="note">
									<a href="<?php echo site_url('auth/login');?>"><?php echo $this->lang->line('__remember_my_password');?></a>
								</div>
							</section>

						</fieldset>
						<footer>
							<button type="submit" id="submit" class="btn btn-primary"> 
								<i class="fa fa-refresh"></i> <?php echo $this->lang->line('__reset_password');?>
							</button>
						</footer>
					</form>

				</div>

				<a href="<?php echo site_url('auth/login');?>">← <?php echo sprintf($this->lang->line('__cancel_and_return'), $this->config->item('app_name'));?></a>
				
			</div>
		</div>
	</div>
<script type="text/javascript">

	runAllForms();

	$(function() {
		$("#login-form input:first").focus();
		// Validation
		$("#login-form").validate({
			// Rules for form validation
			rules : {
				email : {
					required : true,
					email : true,
					remote: {
                        url: BASE_URL+'auth/checkexistemail1',
                        type: "post",
                        data: {
                            email: function(){ 
                            	return $("#email").val();
                            }
                        }
                    }
				}
			},
			// Messages for form validation
			messages : {
				email : {
					required : '<i class="fa fa-exclamation-circle"></i> <?php echo sprintf($this->lang->line('__validate_required'), 'email');?>',
					email : '<i class="fa fa-exclamation-circle"></i> <?php echo sprintf($this->lang->line('__validate_email'), 'email');?>',
					remote: '<i class="fa fa-exclamation-circle"></i> <?php echo sprintf($this->lang->line('__validate_remote'), 'email');?>'
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
								window.location.href = BASE_URL+'auth/login';
							}, 5000);
						}
						else
						{
							$.smallBox({
								title : "Error",
								content : response.message,
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