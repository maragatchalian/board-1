<h2>Hi! <?php to_html_entities($user->first_name) ?></h2>

<p class="alert alert-success">
    You have successfully registered an account
</p>

<a href="<?php to_html_entities(url('user/login')) ?>">
    You can now log in here
</a>


                        