
<h1><?php to_html_entities($thread->title) ?></h1>

<div>
  <?php echo $thread->countFollow() ?> Followers  
</div>

<!-- Follow Thread -->
<?php if (!$thread->isFollowed()) : ?>
  <a href="<?php to_html_entities(url('thread/addfollow', array('thread_id'=>$thread->id)))?>">Follow this thread</a> 
<?php else : ?>
  <a href="<?php to_html_entities(url('thread/removefollow', array('thread_id'=>$thread->id)))?>">Unfollow this thread</a> 
<?php endif?> 

<!-- Delete Thread -->
<?php if ($thread->isUserThread()) : ?>
   | <a href="<?php to_html_entities(url('thread/delete', array('thread_id'=>$thread->id)))?>"
    onclick="return confirm('Are you sure you want to delete this thread?')"> 
      Delete this thread
    </a>
<?php endif ?>
 
<br />

<?php foreach ($comments as $comment) : ?>
  <div class="comment">
    <div>
        <img class="small-avatar" src="/bootstrap/img/default-avatar.png" alt="Defaut Avatar Image">
      </div>

      <div class="meta">
          <h4><?php to_html_entities(User::getUsername($comment->user_id)) ?></h4> 

          <?php to_html_entities($comment->created) ?>
      </div>
      
      <div><?php echo readable_text($comment->body) ?></div>
    
      <div>
        <!-- Like Comment -->
        <?php if ($comment->isCommentLiked()) : ?>
          <a href="<?php to_html_entities(url('comment/addLike', array('comment_id'=>$comment->id)))?>"><i class="icon-heart"></i></a> 
        <?php else : ?>
          <a href="<?php to_html_entities(url('comment/removeLike', array('comment_id'=>$comment->id)))?>" class="red"><i class="icon-heart icon-red"></i></a>
        <?php endif ?>
        
        <!-- Count Likes -->
        <?php echo $comment->countLike() ?> Likes
        
        <!-- Delete Comment -->  
        <?php if ($comment->isUserComment()) : ?>
          | <a href="<?php to_html_entities(url('comment/delete', array('comment_id'=>$comment->id)))?>"
          onclick="return confirm('Are you sure you want to delete this comment?')"> 
            Delete this comment
          </a>
        <?php endif ?>
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