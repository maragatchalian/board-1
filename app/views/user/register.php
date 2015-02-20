<h1>Register (free)</h1>

<?php if ($user->hasError()): ?>
    <div class="alert alert-block">
        <h4 class="alert-heading">Validation error!</h4>
        
        <?php if (!empty($user->validation_errors['username']['length'])): ?>            
        
        <div><em>Your Username</em> must be between                
            <?php eh($user->validation['username']['length'][1]) ?> and                    
            <?php eh($user->validation['username']['length'][2]) ?> characters in length.
        </div>
        <?php endif //Username Validation ?>

        <?php if (!empty($user->validation_errors['first_name']['length'])): ?>            
        
        <div><em>Your First Name</em> must be between                
            <?php eh($user->validation['first_name']['length'][1]) ?> and                    
            <?php eh($user->validation['first_name']['length'][2]) ?> characters in length.
        </div>
        <?php endif //First Name Validation ?>

        <?php if (!empty($user->validation_errors['last_name']['length'])): ?>            
        
        <div><em>Your Last Name</em> must be between                
            <?php eh($user->validation['last_name']['length'][1]) ?> and                    
            <?php eh($user->validation['last_name']['length'][2]) ?> characters in length.
        </div>
        <?php endif //Last Name Validation ?>

        <?php if (!empty($user->validation_errors['email']['length'])): ?>            
        
        <div><em>Your Email</em> must be between                
            <?php eh($user->validation['email']['length'][1]) ?> and                    
            <?php eh($user->validation['email']['length'][2]) ?> characters in length.
        </div>
        <?php endif //Email Validation ?>

        <?php if (!empty($user->validation_errors['password']['length'])): ?>            
        
        <div><em>Your Password</em> must be between                
            <?php eh($user->validation['password']['length'][1]) ?> and                    
            <?php eh($user->validation['password']['length'][2]) ?> characters in length.
        </div>
        <?php endif //Password Validation ?>

        <?php if (!empty($user->validation_errors['confirm_password']['length'])): ?>            
        
        <div><em>Your Confirm Password</em> must be between                
            <?php eh($user->validation['confirm_password']['length'][1]) ?> and                    
            <?php eh($user->validation['confirm_password']['length'][2]) ?> characters in length.
        </div>
        <?php endif //Confirm Password Validation ?>

    </div>
<?php endif ?>
    
<form action="<?php eh(url('')) ?>" method="post">

    <div class="span12">
        <label for="username"><h4>Username</h4></label>
        <input type="text" name="username" value="<?php eh(Param::get('username')) ?>">
    </div>

    <div class="span12">
        <label for="first_name"><h4>First Name</h4></label>
        <input type="text" name="first_name" value="<?php eh(Param::get('first_name')) ?>">
    </div>

    <div class="span12">
        <label for="last_name"><h4>Last Name</h4></label>
        <input type="text" name="last_name" value="<?php eh(Param::get('last_name')) ?>">
    </div>

    <div class="span12">
         <label for="email"><h4>Email</h4></label>
        <input type="email" name="email" value="<?php eh(Param::get('email')) ?>">
    </div>

    <div class="span12">
        <label for="password"><h4>Password</h4></label>
        <input type="password" name="password" value="<?php eh(Param::get('password')) ?>">
    </div>
    
    <br />

    <div class="span12">
        <label for="confirm_password"><h4>Confirm Password</h4></label>
        <input type="password" name="confirm_password" value="<?php eh(Param::get('confirm_password')) ?>">
    </div>

    <input type="hidden" name="page_next" value="register_end">

    <div class="span12">
        <button class="btn btn-info btn-large" type="submit">Register me</button>
    </div>
    
</form>