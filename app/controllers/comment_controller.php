<?php 
Class CommentController extends AppController
{
    public function most_liked()
    {
        $comments = Comment::get_most_liked();

        $this->set(get_defined_vars());
    }

    public function delete()
    {
        $comment = Comment::get(Param::get('comment_id'));
        $comment->delete();
    }

    public function likes()
    {
        $comment = Comment::get(Param::get('comment_id'));
        $comment->likes();
    }

    public function unlikes()
    {
        $comment = Comment::get(Param::get('comment_id'));
        $comment->unlikes();
    }
}
