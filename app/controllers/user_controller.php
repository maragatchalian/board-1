<?php 
class UserController extends AppController
{
    public function register() 
    {
        if (is_logged_in()) {
            redirect(url('user/home'));
        }
        
        $params = array(
            'username' => trim(Param::get('username')),
            'first_name' => trim(Param::get('first_name')),
            'last_name' => trim(Param::get('last_name')),
            'email' => trim(Param::get('email')),
            'password' => Param::get('password'),
            'confirm_password' => Param::get('confirm_password'),
        );

        $user = new User($params);
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
            redirect(url('user/home'));
        }

        $params = array(
            'username' => trim(Param::get('username')),
            'password' => Param::get('password'),
        );

        $user = new User($params);
        $page = Param::get('page_next', 'login');
 
        switch ($page) {
            case 'login':
                break;
            case 'home':
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

    public function home()
    {
       $this->set(get_defined_vars());
    }
}
 