<h1>Top 10 Threads with most followers</h1>

<ol>
  <?php foreach ($threads as $thread) : ?>
    <li><a href="<?php to_html_entities(url('thread/view', array('thread_id' => $thread->thread_id))) ?>"><?php Thread::getTitle($thread->thread_id) ?></a></li>
  <?php endforeach; ?>
</ol>
