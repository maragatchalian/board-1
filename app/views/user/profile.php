<h1>Profile</h1>

<div>
    <b>Username: </b><?php echo $user->username ?>
</div>

<div>
    <b>First Name: </b><?php echo $user->first_name ?>
</div>

<div>
    <b>Last Name: </b><?php echo $user->last_name ?>
</div>

<div>
    <b>email: </b><?php echo $user->email ?>
</div>

<br />

<div>
    <a href="<?php to_html_entities(url('user/edit')) ?>">Edit Profile</a>
</div>