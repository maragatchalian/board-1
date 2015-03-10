<?php 
Class CommentController extends AppController
{
    public function mostLiked()
    {
        $comments = Comment::get_most_liked();
        $this->set(get_defined_vars());
    }

    public function delete()
    {
        $comment = Comment::get(Param::get('comment_id'));
        $comment->delete();

        redirect(url('thread/view', array('thread_id' =>$_SESSION['thread_id'])));
    }

    public function likes()
    {
        $comment = Comment::get(Param::get('comment_id'));
        $comment->likes();

        redirect(url('thread/view', array('thread_id' => $_SESSION['thread_id'])));
    }

    public function unlikes()
    {
        $comment = Comment::get(Param::get('comment_id'));
        $comment->unlikes();

        redirect(url('thread/view', array('thread_id' => $_SESSION['thread_id'])));   
    }
}
