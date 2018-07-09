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
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember')
);
?>
<!-- MAIN CONTENT -->
<div id="content" class="container">

	<div class="row">

		<div class="col-sm-6 col-md-offset-3">
			<div class="well no-padding">
				<?php echo form_open('auth/doLogin', 'id="login-form" class="smart-form client-form"'); ?>
					<header>
						<?php echo $this->lang->line('__signin');?>
					</header>

					<fieldset>
						
						<section>
							<label class="label"><?php echo $this->lang->line('__email');?></label>
							<label class="input"> <i class="icon-append fa fa-user"></i>
								<?php echo form_input($login); ?>
								<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> <?php echo $this->lang->line('__enter_email_username');?></b></label>
						</section>

						<section>
							<label class="label"><?php echo $this->lang->line('__password');?></label>
							<label class="input"> <i class="icon-append fa fa-lock"></i>
								<td><?php echo form_password($password); ?></td>
								<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> <?php echo $this->lang->line('__enter_password');?></b> </label>
							<div class="note">
								<a href="<?php echo site_url('auth/forgot_password');?>"><?php echo $this->lang->line('__forgot_password');?></a>
							</div>
						</section>

						<section>
							<label class="checkbox">
								<?php echo form_checkbox($remember); ?>
								<i></i><?php echo $this->lang->line('__stay_signed_in');?></label>
						</section>
					</fieldset>
					<footer>
						<!-- <a href="<?php //echo $loginUrl;?>" class="btn btn-primary hidden"> <i class="fa fa-facebook"></i> Register </a> -->
						<a href="<?php echo site_url('auth/register');?>" class="btn btn-primary"> Register </a>
						<button type="submit" id="submit" class="btn btn-primary">
							<?php echo $this->lang->line('__signin');?> 
						</button>
							
					</footer>
				</form>
				
			</div>
			<h5 class="hidden text-center"> - Or sign in using -</h5>
														
			<ul class="hidden list-inline text-center">
				
				<li>
					<a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>
				</li>
				<li>
					<a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>
				</li>
			</ul>
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
				login : {
					required : true,
					email : true
				},
				password : {
					required : true,
					minlength : 3,
					maxlength : 20
				}
			},
			// Messages for form validation
			messages : {
				login : {
					required : '<i class="fa fa-exclamation-circle"></i> <?php echo sprintf($this->lang->line('__validate_required'), 'email');?>',
					email : '<i class="fa fa-exclamation-circle"></i> <?php echo $this->lang->line('__validate_email');?>'
				},
				password : { 
					required : '<i class="fa fa-exclamation-circle"></i> <?php echo sprintf($this->lang->line('__validate_required'), 'password');?>',
					minlength : '<i class="fa fa-exclamation-circle"></i> <?php echo sprintf($this->lang->line('__validate_minlength'), 3);?>',
					maxlength : '<i class="fa fa-exclamation-circle"></i> <?php echo sprintf($this->lang->line('__validate_maxlength'), 20);?>'
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