<h2><?php to_html_entities($thread->title) ?></h2>
            
<p class="alert alert-success">
  You successfully created.                
</p>
                        
<a href="<?php to_html_entities(url('thread/view', array('thread_id' => $thread->id))) ?>">
    &larr; Go to thread                    
</a>