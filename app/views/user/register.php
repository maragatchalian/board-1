<h1>Register</h1>

<?php if ($user->hasError()) : ?>
    <div class="alert alert-block">

       <h4 class="alert-heading">Validation error!</h4>
        
        <!-- Check Username Length -->
        <?php if (!empty($user->validation_errors['username']['length'])) : ?>            
            <div><em>Your Username</em> must be between                
                <?php to_html_entities($user->validation['username']['length'][1]) ?> and                    
                <?php to_html_entities($user->validation['username']['length'][2]) ?> characters in length.
            </div>
        <?php endif ?>
        
        <!-- Check If Username Exist -->
        <?php if (!empty($user->validation_errors['username']['exist'])) : ?>            
            <div>
                <em>Username is already taken</em>              
            </div>
        <?php endif ?>

        <!-- Check First Name Length -->
        <?php if (!empty($user->validation_errors['first_name']['length'])) : ?>            
             <div><em>Your First Name</em> must be between                
                <?php to_html_entities($user->validation['first_name']['length'][1]) ?> and                    
                <?php to_html_entities($user->validation['first_name']['length'][2]) ?> characters in length.
            </div>
        <?php endif ?>
        
        <!-- Check Last Name Length -->
        <?php if (!empty($user->validation_errors['last_name']['length'])) : ?>            
            <div><em>Your Last Name</em> must be between                
                <?php to_html_entities($user->validation['last_name']['length'][1]) ?> and                    
                <?php to_html_entities($user->validation['last_name']['length'][2]) ?> characters in length.
            </div>
        <?php endif ?>
        
        <!-- Check Email Length -->
        <?php if (!empty($user->validation_errors['email']['length'])) : ?>            
            <div><em>Your Email</em> must be between                
                <?php to_html_entities($user->validation['email']['length'][1]) ?> and                    
                <?php to_html_entities($user->validation['email']['length'][2]) ?> characters in length.
            </div>
        <?php endif ?>
        
        <!-- Check If Email Exist -->
        <?php if (!empty($user->validation_errors['email']['exist'])) : ?>            
             <div>
                <em>Email is already registered</em>              
            </div>
        <?php endif ?>
        
        <!-- Check Password Length -->
        <?php if (!empty($user->validation_errors['password']['length'])) : ?>            
            <div><em>Your Password</em> must be between                
                <?php to_html_entities($user->validation['password']['length'][1]) ?> and                    
                <?php to_html_entities($user->validation['password']['length'][2]) ?> characters in length.
            </div>
        <?php endif  ?>
        
        <!-- Check If Password And Confirm Password Match -->
        <?php if (!empty($user->validation_errors['confirm_password']['match'])) : ?>            
            <div>
                <em>Your Password</em> must be equal to your 
                <em>Current Password</em>                
            </div>
        <?php endif ?>

    </div>
<?php endif ?>
    
<form action="<?php to_html_entities(url('')) ?>" method="post">

    <div class="span12">
        <label for="username"><h4>Username</h4></label>
        <input type="text" name="username" value="<?php to_html_entities(Param::get('username')) ?>">
    </div>

    <div class="span12">
        <label for="first_name"><h4>First Name</h4></label>
        <input type="text" name="first_name" value="<?php to_html_entities(Param::get('first_name')) ?>">
    </div>

    <div class="span12">
        <label for="last_name"><h4>Last Name</h4></label>
        <input type="text" name="last_name" value="<?php to_html_entities(Param::get('last_name')) ?>">
    </div>

    <div class="span12">
         <label for="email"><h4>Email</h4></label>
        <input type="email" name="email" value="<?php to_html_entities(Param::get('email')) ?>">
    </div>

    <div class="span12">
        <label for="password"><h4>Password</h4></label>
        <input type="password" name="password" value="<?php to_html_entities(Param::get('password')) ?>">
    </div>
    
    <br />

    <div class="span12">
        <label for="confirm_password"><h4>Confirm Password</h4></label>
        <input type="password" name="confirm_password" value="<?php to_html_entities(Param::get('confirm_password')) ?>">
    </div>

    <input type="hidden" name="page_next" value="register_end">

    <div class="span12">
        <button class="btn btn-info btn-large" type="submit">Register me</button>
        
        <br />
        <br />

        <a href="<?php to_html_entities(url('user/login')) ?>">Already have an account? Log in here</a>
    </div>
</form>