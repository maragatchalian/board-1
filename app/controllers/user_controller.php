<?php 
class UserController extends AppController
{
    public function register() 
    {
        if (is_logged_in()) {
            redirect(url('user/index'));
        }
        
        $params = array(
            'username' => Param::get('username'),
            'first_name' => Param::get('first_name'),
            'last_name' => Param::get('last_name'),
            'email_address' => Param::get('email_address'),
            'password' => Param::get('password'),
            'confirm_password' => Param::get('confirm_password')    
        );   

        $user = new User($params);
        $page = Param::get('page_next', 'register');
 
        switch ($page){
            case 'register':
                break;
            case 'register_end':
                try{
                    $user->register();
                } catch (ValidationException $e){
                    $page = 'register';
                }
                break;  
            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function login()
    {
        if (is_logged_in()) {
            redirect(url('user/index'));
        }
        $params = array(
            'username' => Param::get('username'),
            'password' => Param::get('password'),
        );
        $user = new User($params);
        $page = Param::get('page_next', 'login');
 
        switch ($page) {
            case 'login':
                break;
            case 'index':
                try {
                    $user->login();
                    redirect(url('user/index'));
                } catch (ValidationException $e) {
                    $page = 'login';
                }
                break;
            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);   
    }

     public function logout()
    {
        session_destroy();
        redirect(url('user/login'));
    }

    public function index()
    {
        $user = User::get();
        $this->set(get_defined_vars());
    }

    public function profile()
    {
        $user = User::get();
        $this->set(get_defined_vars());
    }

    public function edit()
    {
        $params = array(
            'first_name' => Param::get('first_name'),
            'last_name' => Param::get('last_name'),
            'email_address' => Param::get('email_address')
        );
        $user = new User($params);
        $page = Param::get('page_next', 'edit');
 
        switch ($page) {
            case 'edit':
                break;
            case 'edit_end':
                try {
                    $user->updateProfile();
                } catch (ValidationException $e) {
                    $page = 'edit';
                }
                break;
            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);   
    }
    
    public function mostFollowed()
    {
        $threads = Thread::getMostFollowed();
        $this->set(get_defined_vars());
    }

    public function avatar()
    {
        $user = User::get();
        $this->set(get_defined_vars());
    }

    public function setAvatar()
    {   
        $user = User::get();
        $this->set(get_defined_vars());
        $user->setAvatar(Param::get('image_path'));
        $this->render('user/setAvatar');
    }

}
 