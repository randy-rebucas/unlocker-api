<div class="row breadcrumbs">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>Login</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="active">Login</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
<?php
$login = array(
    'name'  => 'login',
    'id'    => 'login',
    'class'    => 'form-control',
    'placeholder'    => 'E-mail',
    'value' => set_value('login'),
    'maxlength' => 80
);
if ($login_by_username AND $login_by_email) {
    $login_label = 'Email or login';
} else if ($login_by_username) {
    $login_label = 'Login';
} else {
    $login_label = 'Email';
}
$password = array(
    'name'  => 'password',
    'id'    => 'password',
    'class'    => 'form-control',
    'placeholder'    => 'Password',
);
$captcha = array(
    'name'  => 'captcha',
    'id'    => 'captcha',
    'maxlength' => 8,
);
?>
<!-- BEGIN CONTAINER -->   
        <div class="container margin-bottom-40">
          <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 login-signup-page">
                <?php echo form_open($this->uri->uri_string()); ?>         
                    
                    <h2>Login to your account</h2>
                    <?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']]) ? $errors[$login['name']] :''; ?>
                    <?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']]) ? $errors[$password['name']] :''; ?>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <?php echo form_input($login); ?>
                        <!-- <input type="text" class="form-control" placeholder="E-mail"> -->
                    </div>                    
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                       <!--  <input type="password" class="form-control" placeholder="Password"> -->
                        <?php echo form_password($password); ?> 
                        <!-- <a href="#" class="login-signup-forgot-link">Forgot?</a> -->
                    </div>                    

					
					<div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="checkbox-list"><label class="checkbox"><input type="checkbox" name="remember" id="remember" value="1" checked="<?php echo set_value('remember');?>"> Remember me</label></div>                        
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn theme-btn pull-right">Login</button>                        
                        </div>
                    </div>
                    <hr>

                    <div class="hidden login-socio">
                        <p class="text-muted">or login using:</p>
                        <ul class="social-icons">
                            <li><a class="facebook" data-original-title="facebook" href="#"></a></li>
                            <li><a class="twitter" data-original-title="Twitter" href="#"></a></li>
                            <li><a class="googleplus" data-original-title="Goole Plus" href="#"></a></li>
                            <li><a class="linkedin" data-original-title="Linkedin" href="#"></a></li>
                        </ul>
                    </div>

<?php echo form_close(); ?>
            </div>
          </div>
        </div>
        <!-- END CONTAINER -->