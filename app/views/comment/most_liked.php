<h1>Top 10 Liked Comments</h1>

<ol>
  <?php foreach ($comments as $comment) : ?>
    <li>
        <a href="<?php to_html_entities(url('thread/view',
                array('thread_id' => $comment->get_thread_id()))) ?>">
        <?php echo $comment->getCommentSnippet() ?>
        </a>
        <em><?php echo $comment->total_likes ?> Likes</em>
    </li>
  <?php endforeach; ?>
</ol>
