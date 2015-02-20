<?php 
class UserController extends AppController
{
    public function register() 
    {
        $params = array(
            'username' => trim(Param::get('username')),
            'first_name' => trim(Param::get('first_name')),
            'last_name' => trim(Param::get('last_name')),
            'email' => trim(Param::get('email')),
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
}
 