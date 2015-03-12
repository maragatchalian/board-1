<h1>User Avatar</h1>
<br>
<img src="<?php echo $user->getImagePath($user->id) ?>" alt="User Avatar">
<h5>Your Current Avatar</h5>
<br>
<h2>Choose from the selection below:</h2>
<div class="row">
    <div class="span2"><a href="<?php to_html_entities(url('user/setAvatar', array('image_path' => 1))); ?>"><img src="/bootstrap/img/avatar-milk.gif" alt=""></a><h4>Mr. Milk</h4></div>
    <div class="span2"><a href="<?php to_html_entities(url('user/setAvatar', array('image_path' => 2))); ?>"><img src="/bootstrap/img/avatar-french-fries.gif" alt=""></a><h4>Lonely Fries</h4></div>
    <div class="span2"><a href="<?php to_html_entities(url('user/setAvatar', array('image_path' => 3))); ?>"><img src="/bootstrap/img/avatar-ghost.gif" alt=""></a><h4>The Ghost</h4></div>
</div>

<div class="row">
    <div class="span2"><a href="<?php to_html_entities(url('user/setAvatar', array('image_path' => 4))); ?>"><img src="/bootstrap/img/avatar-strawberry.gif" alt=""></a><h4>Lovely Berry</h4></div>
    <div class="span2"><a href="<?php to_html_entities(url('user/setAvatar', array('image_path' => 5))); ?>"><img src="/bootstrap/img/avatar-sushi.gif" alt=""></a><h4>Sushi desu~</h4></div>
     <div class="span2"><a href="<?php to_html_entities(url('user/setAvatar', array('image_path' => 6))); ?>"><img src="/bootstrap/img/avatar-finn.gif" alt=""></a><h4>Finn the Human</h4></div>
</div>

<div class="row">
    <div class="span2"><a href="<?php to_html_entities(url('user/setAvatar', array('image_path' => 7))); ?>"><img src="/bootstrap/img/avatar-flame-princess.gif" alt=""></a><h4>Flame Princess</h4></div>
    <div class="span2"><a href="<?php to_html_entities(url('user/setAvatar', array('image_path' => 8))); ?>"><img src="/bootstrap/img/avatar-lee.gif" alt=""></a><h4>Marshall Lee</h4></div>
     <div class="span2"><a href="<?php to_html_entities(url('user/setAvatar', array('image_path' => 9))); ?>"><img src="/bootstrap/img/avatar-pb.gif" alt=""></a><h4>Princess Bubblegum</h4></div>
</div>