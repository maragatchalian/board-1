<?php 
class User extends AppModel
{   
    //Minimum Length Values  
    const MIN_USERNAME_LENGTH = 1;
    const MIN_FIRST_NAME_LENGTH = 1;
    const MIN_LAST_NAME_LENGTH = 1;
    const MIN_EMAIL_LENGTH = 1;
    const MIN_PASSWORD_LENGTH = 8;

    //Maximum Length Values
    const MAX_USERNAME_LENGTH = 20;
    const MAX_FIRST_NAME_LENGTH = 254;
    const MAX_LAST_NAME_LENGTH = 254;
    const MAX_EMAIL_LENGTH = 254;
    const MAX_PASSWORD_LENGTH = 20;

    public $is_validated = true;

    public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', self::MIN_USERNAME_LENGTH, self::MAX_USERNAME_LENGTH,
            ),

            'exist' => array(
                'is_username_exist',                         
            )
        ),
                
        'first_name' => array(
            'length' => array(
                'validate_between', self::MIN_FIRST_NAME_LENGTH, self::MAX_FIRST_NAME_LENGTH,
            )
        ),

        'last_name' => array(
            'length' => array(
                'validate_between', self::MIN_LAST_NAME_LENGTH, self::MAX_LAST_NAME_LENGTH,
            )
        ),

        'email' => array(
            'length' => array(
                'validate_between', self::MIN_EMAIL_LENGTH, self::MAX_EMAIL_LENGTH,
            ),

            'exist' => array(
                'is_email_exist',                         
            )
        ),

        'password' => array(
            'length' => array(
                'validate_between', self::MIN_PASSWORD_LENGTH, self::MAX_PASSWORD_LENGTH,
            )
        ),

        'confirm_password' => array(
           'match' => array(
                'is_password_match',                 
            )
        ),
    );

    public function register()
    {
        $this->validate();

        if ($this->hasError()) {
            throw new ValidationException('Invalid user credentials');
        }

        $db = DB::conn();
        
        try {
            $db->begin();
            $db->insert(
                'user', array(
                    'username' => $this->username,
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'email' => strtolower($this->email),
                    'password' => md5($this->password)
                    )   
                );
            $db->commit();

        }catch(Exception $e) {
            $db->rollback();
            throw $e;
        }
    }

    public function login()
    {
        $db = DB::conn();
        $params = array(
            'username' => $this->username,
            'password' => md5($this->password) 
        );
        
        $user = $db->row("SELECT id, username FROM user WHERE BINARY username = :username &&  BINARY password = :password", $params);
        
        if (!$user) {
            $this->is_validated = false; 
            throw new RecordNotFoundException('No Record Found');   
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] =$user['username'];
    }

    public function is_password_match()
    {
        return $this->password == $this->confirm_password;
    }

    public function is_username_exist()
    {
        $db = DB::conn();
        $username_exist = $db->row("SELECT username FROM user WHERE username = ?", array($this->username));

        return !$username_exist;
    }

       public function is_email_exist()
    {
        $db = DB::conn();
        $username_exist = $db->row("SELECT email FROM user WHERE email = ?", array($this->email));

        return !$username_exist;
    }
}
