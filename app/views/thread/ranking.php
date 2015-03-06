<h1>Top 10 Threads</h1>
<br />
<br />
<h2>Threads with most followers</h2>

<ul>
  <?php foreach ($threads as $thread) : ?>
    <li><a href="<?php to_html_entities(url('thread/view', array('thread_id' => $thread->thread_id))) ?>"><?php echo $thread->thread_id ?></a></li>
  <?php endforeach; ?>
</ul>
