<?php 
class UserController extends AppController
{
    public function register() 
    {
        if (is_logged_in()) {
            redirect(url('user/index'));
        }
        
        $user = new User(array(
                            'username' => Param::get('username'),
                            'first_name' => Param::get('first_name'),
                            'last_name' => Param::get('last_name'),
                            'email' => Param::get('email'),
                            'password' => Param::get('password'),
                            'confirm_password' => Param::get('confirm_password')
                            )
                        );

        $page = Param::get('page_next', 'register');
 
        switch ($page){
            case 'register':
                break;
            case 'register_end':
                try{
                    $user->register();
                }catch (ValidationException $e){
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
                }catch (ValidationException $e) {
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
            'email' => Param::get('email')
        );

        $user = new User($params);
        $page = Param::get('page_next', 'edit');
 
        switch ($page) {
            case 'edit':
                break;
            case 'edit_end':
                try {
                    $user->update();
                }catch (ValidationException $e) {
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
}
 