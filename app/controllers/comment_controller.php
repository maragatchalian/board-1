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
}
