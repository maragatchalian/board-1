<?php 
class Comment extends AppController
{
    const MAX_ITEMS_PER_PAGE = 5;

     public function view()
    {
        $thread_id = Param::get('thread_id');

        $page = Param::get('page', 1);
        $pagination = new SimplePagination($page, self::MAX_ITEMS_PER_PAGE) ;

        $thread = Thread::get($thread_id);

       


        $comments = Comment::getAll($pagination->start_index -1, $pagination->count + 1, $thread_id);

        $pagination->checkLastPage($comments);
       
        $total = Comment::countAll($thread_id);
        $num_pages = ceil($total / self::MAX_ITEMS_PER_PAGE);

        $this->set(get_defined_vars()); 
    }

    public function write()
    {
        $thread_id = Param::get('thread_id');
        $thread = Thread::get($thread_id);

        $comment = new Comment($thread_id);
        $page = Param::get('page_next', 'write');

        switch($page) { 
            case 'write':
            break;

            case 'write_end':                
            $comment->username = Param::get('username');
            $comment->body = Param::get('body');
            try {            
                $comment->write($comment);
            } 
            catch (ValidationException $e) {                    
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