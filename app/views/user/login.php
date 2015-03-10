<h1>Login</h1>

<?php if (!$user->is_validated) : ?>
    <div class="alert alert-block">
        <h4 class="alert-heading">Validation error!</h4>
        <em>Invalid Username or Password</em>                
    </div>
<?php endif ?>
    
<form action="<?php to_html_entities(url('')) ?>" method="post">

    <div class="span12">
        <label for="username"><h4>Username</h4></label>
        <input type="text" name="username" value="<?php to_html_entities(Param::get('username')) ?>">
    </div>

    <div class="span12">
        <label for="password"><h4>Password</h4></label>
        <input type="password" name="password" value="<?php to_html_entities(Param::get('password')) ?>">
    </div>
    
    <br />

    <input type="hidden" name="page_next" value="index">

    <div class="span12">
        <button class="btn btn-info btn-large" type="submit">Login</button>
        
        <br />
        <br />
        
        <a href="<?php to_html_entities(url('user/register')) ?>">Don't have an account? Register here</a>
    </div>
</form>