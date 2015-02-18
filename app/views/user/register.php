<form action="" method="post">
    <h1>Register (free)</h1>
    
    <div class="span12">
        <label for="username"><h4>Username</h4></label>
        <input type="text" name="username" required>
    </div>

    <div class="span12">
        <label for="first_name"><h4>First Name</h4></label>
        <input type="text" name="first_name" required>
    </div>

    <div class="span12">
        <label for="last_name"><h4>Last Name</h4></label>
        <input type="text" name="last_name" required>
    </div>

    <div class="span12">
         <label for="email"><h4>Email</h4></label>
        <input type="email" name="email" required>
    </div>

    <div class="span12">
        <label for="password"><h4>Password</h4></label>
        <input type="password" name="Password" required>
    </div>
    
    <br />

    <div class="span12">
        <label for="confirm_password"><h4>Confirm Password</h4></label>
        <input type="text" name="confirm_password" required>
    </div>

    <input type="hidden" name="page_next" value="success">

    <div class="span12">
        <button class="btn btn-info btn-large" type="submit">Register me</button>
    </div>
</form>