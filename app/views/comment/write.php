<h2><?php to_html_entities($thread->title) ?></h2>

<?php if ($comment->hasError()) : ?>
    <div class="alert alert-block">
        <h4 class="alert-heading">Validation error!</h4>
        
        <!-- Check Username Length -->
        <?php if (!empty($comment->validation_errors['username']['length'])) : ?>            
            <div>
                <em>Your Username</em> must be between                
                <?php to_html_entities($comment->validation['username']['length'][1]) ?> and                    
                <?php to_html_entities($comment->validation['username']['length'][2]) ?> characters in length.
            </div>
        <?php endif ?>
        
        <!-- Check Comment Length -->
        <?php if (!empty($comment->validation_errors['body']['length'])) : ?>                
            <div>
                <em>Your Comment</em> must be between 
                <?php to_html_entities($comment->validation['body']['length'][1]) ?> and                    
                 <?php to_html_entities($comment->validation['body']['length'][2]) ?> characters in length.
            </div>            
        <?php endif ?>
    </div>                    
<?php endif ?>
            
<form class="well" method="post" action="<?php to_html_entities(url('thread/write')) ?>">
    <label>Comment</label>
    <textarea name="body"><?php to_html_entities(Param::get('body')) ?></textarea>
    
    <br />
    
    <input type="hidden" name="thread_id" value="<?php to_html_entities($thread->id) ?>">
    <input type="hidden" name="page_next" value="write_end">
    <button type="submit" class="btn btn-primary">Submit</button>
</form> 
