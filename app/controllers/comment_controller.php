<?php 
Class CommentController extends AppController
{
    public function mostLiked()
    {
        $comments = Comment::getMostLiked();
        $this->set(get_defined_vars());
    }

    public function delete()
    {
        $comment = Comment::get(Param::get('comment_id'));
        $comment->delete();
        redirect(url('thread/view', array('thread_id' => $_SESSION['thread_id'])));
    }

    public function addLike()
    {
        $comment = Comment::get(Param::get('comment_id'));
        $comment->addLike();
        redirect(url('thread/view', array('thread_id' => $_SESSION['thread_id'])));
    }

    public function removeLike()
    {
        $comment = Comment::get(Param::get('comment_id'));
        $comment->removeLike();
        redirect(url('thread/view', array('thread_id' => $_SESSION['thread_id'])));   
    }

     public function write()
    {   $thread_id = Param::get('thread_id');
        $thread = Thread::get($thread_id);
        $comment = new Comment;
        $page = Param::get('page_next', 'write');

        switch($page) { 
            case 'write':
                break;
            case 'write_end':                
                $comment->body = Param::get('body');
                try {            
                    $comment->write($comment, $thread_id);
                } catch (ValidationException $e) {                    
                    $page = 'write';
                }                        
                break;
            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }
}
