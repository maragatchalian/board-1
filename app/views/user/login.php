<h1>Login</h1>

<?php if ($user->hasError()): ?>
    <div class="alert alert-block">
        <h4 class="alert-heading">Validation error!</h4>
        
        <?php if (!empty($user->validation_errors['password']['correct'])): ?>            
        
        <div>
            <em>Invalid Username or Password</em>                
        </div>
        <?php endif //Verify User Account ?>
    </div>
<?php endif ?>
    
<form action="<?php eh(url('')) ?>" method="post">

    <div class="span12">
        <label for="username"><h4>Username</h4></label>
        <input type="text" name="username" value="<?php eh(Param::get('username')) ?>">
    </div>

    <div class="span12">
        <label for="password"><h4>Password</h4></label>
        <input type="password" name="password" value="<?php eh(Param::get('password')) ?>">
    </div>
    
    <br />

    <input type="hidden" name="page_next" value="home">

    <div class="span12">
        <button class="btn btn-info btn-large" type="submit">Login</button>
        
        <br />
        <br />
        
        <a href="<?php eh(url('user/register')) ?>">Don't have an account? Register here</a>
    </div>
    
    
   
    
</form>