<h1>Profile</h1>

<div>
    <img src="" alt="">
</div>

<form action="<?php to_html_entities(url('user/edit')) ?>" method="post">
    <div>
         <b>Username: </b><?php echo $user->username ?>
    </div>

    <div>
        <b>First Name: </b><?php echo $user->first_name ?>
        <input type="hidden" name="first_name" value="<?php echo $user->first_name ?>">
    </div>

    <div>
        <b>Last Name: </b><?php echo $user->last_name ?>
        <input type="hidden" name="last_name" value="<?php echo $user->last_name ?>">
    </div>

    <div>
        <b>Email: </b><?php echo $user->email ?>
        <input type="hidden" name="email" value="<?php echo $user->email ?>">
    </div>

    <br />

    <div>
        <button class="btn btn-info btn-large" type="submit">Edit Profile</button>
    </div>
</form>

