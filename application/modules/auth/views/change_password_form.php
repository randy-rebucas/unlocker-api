<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'value' => set_value('old_password'),
	'size' 	=> 30,
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
);
?>
<?php echo form_open('auth/change_password', 'id="forget-password-form" class="smart-form client-form"'); ?>
<fieldset>
	<section>
		<label class="label"><?php echo form_label('Old Password', $old_password['id']); ?></label>
		<label class="input"> <i class="icon-append fa fa-user"></i>
			<?php echo form_password($old_password); ?>
			<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter Old password</b></label>
	</section>
	<section>
		<label class="label"><?php echo form_label('New Password', $new_password['id']); ?></label>
		<label class="input"> <i class="icon-append fa fa-user"></i>
			<?php echo form_password($new_password); ?>
			<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter New password</b></label>
	</section>
	<section>
		<label class="label"><?php echo form_label('Confirm New Password', $confirm_new_password['id']); ?></label>
		<label class="input"> <i class="icon-append fa fa-user"></i>
			<?php echo form_password($confirm_new_password); ?>
			<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter confirmation of new password</b></label>
	</section>
	
</fieldset>
<button type="submit" id="submit" class="btn btn-primary btn-sm">
	Submit
</button>

<?php echo form_close(); ?>
<script type="text/javascript">

	$("#forget-password-form input:first").focus();
	
	var validatefunction = function() {
		
		// Validation
		$("#forget-password-form").validate({
			// Rules for form validation
			rules : {
				old_password : {
					required : true,
					minlength : 3,
					maxlength : 20
				},
				new_password : {
					required : true,
					minlength : 3,
					maxlength : 20
				},
                confirm_new_password : {
                    equalTo : '#new_password'
                },
			},
			// Messages for form validation
			messages : {
				old_password : {
					required : '<i class="fa fa-times-circle"></i> Please enter your password',
                    minlength: '<i class="fa fa-times-circle"></i> The password minimum 20 characters in length.',
                    maxlength: '<i class="fa fa-times-circle"></i> The password can not exceed 20 characters in length.'
				},
				new_password : {
                    required : '<i class="fa fa-times-circle"></i> Please enter your password',
                    minlength: '<i class="fa fa-times-circle"></i> The password minimum 20 characters in length.',
                    maxlength: '<i class="fa fa-times-circle"></i> The password can not exceed 20 characters in length.'
                },
                confirm_password : {
                    required : '<i class="fa fa-times-circle"></i> Please enter your password one more time',
                    equalTo : '<i class="fa fa-times-circle"></i> Please enter the same password as above'
                },
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
						$('#submit').html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Please wait...');
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
							$('.close').trigger('click');
							
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
							$('#submit').text('Submit');
							$('#submit').removeAttr("disabled");
						}                   
						
					},
					dataType:'json'
				});
			}
		});
	
	}
	
	loadScript(BASE_URL+"js/plugin/jquery-validate/jquery.validate.min.js", function(){
        loadScript(BASE_URL+"js/plugin/jquery-form/jquery-form.min.js", validatefunction);
    });
</script>