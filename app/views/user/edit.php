<h1>Edit Profile</h1>

<?php if ($user->hasError()) : ?>

    <div class="alert alert-block">

       <h4 class="alert-heading">Validation error!</h4>
        
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
        
        <!-- Check Email Address Length -->
        <?php if (!empty($user->validation_errors['email_address']['length'])) : ?>            
            <div><em>Your Email Address</em> must be between                
                <?php to_html_entities($user->validation['email_address']['length'][1]) ?> and                    
                <?php to_html_entities($user->validation['email_address']['length'][2]) ?> characters in length.
            </div>
        <?php endif ?>

       <!-- Check If Email Address Exist -->
       <?php if (!empty($user->validation_errors['email_address']['exist'])) : ?>            
            <div>
               <em>Email Address is already registered</em>              
           </div>
       <?php endif ?>
    </div>
<?php endif ?>

<form action="<?php to_html_entities(url('')) ?>" method="post"> 
    <div class="span12">
        <img src="<?php echo $user->getImagePath($_SESSION['user_id']) ?>" alt="User Avatar"> 
        <br />
         <a href ="<?php to_html_entities(url('user/chooseAvatar')) ?>">Choose Avatar</a>
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
        <label for="email_address"><h4>Email</h4></label>
        <input type="text" name="email_address" value="<?php to_html_entities(Param::get('email_address')) ?>">
    </div>
    
    <input type="hidden" name="page_next" value="edit_end">
    
    <div class="span12">
        <br />
        <button class="btn btn-info btn-large" type="submit">Save</button>
        <a href="<?php to_html_entities(url('user/profile')) ?>" class="btn btn-large">Cancel</a>
    </div>
</form>