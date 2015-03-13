<h1>Top 10 Followed Threads </h1>

<ol>
  <?php foreach ($threads as $thread) : ?>
   <li></li>
   <span class = "section">
        <a href="<?php to_html_entities(url('thread/view', array('thread_id' => $thread->thread_id))) ?>"><?php echo Thread::getTitle($thread->thread_id) ?></a>
        <em><?php echo $thread->total_followers ?> Followers</em>
    </span>
    <br><br>
  <?php endforeach; ?>
</ol>
