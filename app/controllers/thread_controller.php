<?php 
class ThreadController extends AppController
{
    const MAX_ITEMS_PER_PAGE = 5;

    public function create()
    {
        $thread = new Thread();
        $comment = new Comment();
        $page = Param::get('page_next', 'create');

        switch ($page) {
            case 'create':
                break;
            case 'create_end':
                $thread->title = Param::get('title');
                $comment->body = Param::get('body');
                try {
                    $thread->create($comment);
                } catch (ValidationException $e) {
                    $page = 'create';
                }
                break;
            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function index()
    {
        $page = Param::get('page', 1);
        $pagination = new SimplePagination($page, self::MAX_ITEMS_PER_PAGE);
        $threads = Thread::getAll($pagination->start_index -1, $pagination->count + 1);
        $pagination->checkLastPage($threads);
        $total = Thread::countAll();
        $num_pages = ceil($total / self::MAX_ITEMS_PER_PAGE);
        $this->set(get_defined_vars()); 
    }

    public function view()
    {
        $thread_id = Param::get('thread_id');
        $_SESSION['thread_id'] = $thread_id;
        $thread = Thread::get($thread_id);
        $page = Param::get('page', 1);
        $pagination = new SimplePagination($page, self::MAX_ITEMS_PER_PAGE) ;
        $comments = Comment::getAll($pagination->start_index -1, $pagination->count + 1, $thread_id);
        $pagination->checkLastPage($comments);
        $total = Comment::countAll($thread_id);
        $num_pages = ceil($total / self::MAX_ITEMS_PER_PAGE);
        $this->set(get_defined_vars()); 
    }

    public function mostFollowed()
    {
        $threads = Thread::getMostFollowed();
        $this->set(get_defined_vars());
    }

    public function delete()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $thread->deleteThread();
        $thread->deleteFollowedThread();
        redirect(url('thread/index'));
    }

    public function addFollow()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $thread->addFollow();
        redirect(url('thread/view', array('thread_id' => $_SESSION['thread_id'])));
    }

    public function removeFollow()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $thread->removeFollow();
        redirect(url('thread/view', array('thread_id' => $_SESSION['thread_id'])));   
    }
}