<h2>Hi! <?php eh($user->username) ?></h2>

<p class="alert alert-success">
    You have successfully registered an account
</p>

<a href="<?php eh(url('user/login')) ?>">
    You can now log in here                    
</a>
                        