<!-- BEGIN BREADCRUMBS -->   
        <div class="row breadcrumbs margin-bottom-40">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>Signup</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Signup</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
<?php 
if ($use_username) {
    $username = array(
        'name'  => 'username',
        'id'    => 'username',
        'value' => set_value('username'),
        'maxlength' => $this->config->item('username_max_length', 'tank_auth'),
        'class'    => 'form-control',
        'placeholder'    => 'Username',
    );
}
$email = array(
    'name'  => 'email',
    'id'    => 'email',
    'value' => set_value('email'),
    'maxlength' => 80,
    'class'    => 'form-control',
    'placeholder'    => 'Email',
);
$password = array(
    'name'  => 'password',
    'id'    => 'password',
    'value' => set_value('password'),
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'class'    => 'form-control',
    'placeholder'    => 'Password',
);
$confirm_password = array(
    'name'  => 'confirm_password',
    'id'    => 'confirm_password',
    'value' => set_value('confirm_password'),
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'class'    => 'form-control',
        'placeholder'    => 'Confirm password',
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
                    
                    <h2>Signup</h2>
                    <?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?>
                    <?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
                    <?php echo form_error($password['name']); ?>
                    <?php echo form_error($confirm_password['name']); ?>
                    <?php if ($use_username) { ?>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <!-- <input type="text" class="form-control" placeholder="Username"> -->
                        <?php echo form_input($username); ?>
                    </div>
                    <?php } ?>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <!-- <input type="text" class="form-control" placeholder="E-mail"> -->
                        <?php echo form_input($email); ?>
                    </div>    
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <!-- <input type="password" class="form-control" placeholder="Password"> -->
                        <?php echo form_password($password); ?>

                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <!-- <input type="password" class="form-control" placeholder="Confirm password"> -->
                        <?php echo form_password($confirm_password); ?>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn theme-btn pull-right">Signup</button>                        
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