<h1><?php to_html_entities($thread->title) ?></h1>

<?php if ($thread->is_followed_thread()) : ?>
  <a href="<?php to_html_entities(url('thread/follow', array('thread_id'=>$thread->id)))?>">Follow this thread</a> 
<?php else :?>
  <a href="<?php to_html_entities(url('thread/unfollow', array('thread_id'=>$thread->id)))?>">Unfollow this thread</a> 
<?php endif // Follow Thread ?> 



<?php if ($thread->is_user_thread()) : ?>
   | <a href="<?php to_html_entities(url('thread/delete', array('thread_id'=>$thread->id)))?>"
    onclick="return confirm('Are you sure you want to delete this thread?')"> 
      Delete this thread
    </a>
<?php endif //Delete Thread ?>
 
<br />

<?php foreach ($comments as $comment) : ?>
    <div class="comment">
        <div class="meta">
            <h4><?php to_html_entities(User::get_username($comment->user_id)) ?></h4> 
            <?php to_html_entities($comment->created) ?>
        </div>
        
        <div><?php echo readable_text($comment->body) ?></div>
      
        <div>
          <?php if ($comment->is_user_comment()) : ?>
            <a href="<?php to_html_entities(url('comment/delete', array('comment_id'=>$comment->id)))?>"
            onclick="return confirm('Are you sure you want to delete this comment?')"> 
              Delete this comment
            </a>
          <?php endif //Delete Comment ?>
        </div>

    </div>
    <br />
<?php endforeach ?>

<!-- pagination -->

<?php if($pagination->current > 1) : ?>
  <a href='?thread_id=<?php to_html_entities($thread->id) ?>&page=<?php echo $pagination->prev ?>'>Previous</a>
<?php else: ?>
  Previous
<?php endif ?>

<?php for($i = 1; $i <= $num_pages; $i++) : ?>
  <?php if($i == $page): ?>
    <?php echo $i ?>
  <?php else: ?>
   <a href='?thread_id=<?php to_html_entities($thread->id) ?>&page=<?php echo $i ?>'><?php echo $i ?></a>
  <?php endif; ?>
<?php endfor; ?>

<?php if(!$pagination->is_last_page) : ?>
  <a href='?thread_id=<?php to_html_entities($thread->id) ?>&page=<?php echo $pagination->next ?>'>Next</a>
<?php else: ?>
  Next
<?php endif ?>

<hr>
                    
<form class="well" method="post" action="<?php to_html_entities(url('thread/write')) ?>">
  <label>Comment</label>
  <textarea name="body"><?php to_html_entities(Param::get('body')) ?></textarea>
  <br />
  <input type="hidden" name="thread_id" value="<?php to_html_entities($thread->id) ?>">
  <input type="hidden" name="page_next" value="write_end">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>