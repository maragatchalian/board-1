<?php 
Class CommentController extends AppController
{
    public function delete()
    {
        $comment = Comment::get(Param::get('comment_id'));
        $comment->delete($thread_id);
    }
}
