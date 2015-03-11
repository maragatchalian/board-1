<?php 
class User extends AppModel
{   
    //Minimum Length Values  
    const MIN_USERNAME_LENGTH = 1;
    const MIN_FIRST_NAME_LENGTH = 1;
    const MIN_LAST_NAME_LENGTH = 1;
    const MIN_EMAIL_ADDRESS_LENGTH = 1;
    const MIN_PASSWORD_LENGTH = 8;
    //Maximum Length Values
    const MAX_USERNAME_LENGTH = 20;
    const MAX_FIRST_NAME_LENGTH = 254;
    const MAX_LAST_NAME_LENGTH = 254;
    const MAX_EMAIL_ADDRESS_LENGTH = 254;
    const MAX_PASSWORD_LENGTH = 20;

    public $is_validated = true;

    public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', self::MIN_USERNAME_LENGTH, self::MAX_USERNAME_LENGTH,
            ),

            'exist' => array(
                'isUserNameExist',                         
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

        'email_address' => array(
            'length' => array(
                'validate_between', self::MIN_EMAIL_ADDRESS_LENGTH, self::MAX_EMAIL_ADDRESS_LENGTH,
            ),

            'exist' => array(
                'isEmailAddressExist',                         
            )
        ),

        'password' => array(
            'length' => array(
                'validate_between', self::MIN_PASSWORD_LENGTH, self::MAX_PASSWORD_LENGTH,
            )
        ),

        'confirm_password' => array(
           'match' => array(
                'isPasswordMatch',                 
            )
        ),
    );

    public function register()
    {
       if (!$this->validate()) {
            throw new ValidationException('Invalid user credentials');
        }
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                'username' => $this->username,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email_address' => strtolower($this->email_address),
                'password' => md5($this->password)
            );   
            $db->insert('user', $params); 
            $db->commit();
        } catch(Exception $e) {
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

        $user = $db->row("SELECT id, first_name FROM user 
                        WHERE BINARY username = :username AND  BINARY password = :password", $params);
        
        if (!$user) {
            $this->is_validated = false; 
            throw new RecordNotFoundException('No Record Found');   
        }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];       
    }

    public function isPasswordMatch()
    {
        return $this->password == $this->confirm_password;
    }

    public function isUsernameExist()
    {
        $db = DB::conn();
        $username_exist = $db->row("SELECT username FROM user 
                                WHERE username = ?", array($this->username));
        return !$username_exist;
    }

    public function isEmailAddressExist()
    {
        $db = DB::conn();
        $params = array(
            $this->email_address, 
            $_SESSION['user_id']
        );
        $email_address_exist = $db->row("SELECT email_address FROM user 
                                WHERE email_address = ? AND id != ?", $params);
        return !$email_exist;
    }

    public static function getUsername($user_id)
    {
        $db = DB::conn();
        $user = $db->row("SELECT username FROM user 
                    WHERE id = ?", array($user_id));    
        return $user['username'];
    }

    public static function get()
    {
        $db = DB::conn();
        $row = $db->row("SELECT * FROM user 
                    WHERE id = ?", array($_SESSION['user_id']));    
        
        if (!$row) {
            throw new RecordNotFoundException('no record found');
        }
        return new self($row);
    }

    public function update()
    {
        if (!$this->validate()) {
            throw new ValidationException('Invalid user credentials');
        }
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email_address' => strtolower($this->email_address)
            );
            $db->update('user', $params,
                        array('id' => $_SESSION['user_id'])   
                    );
            $db->commit();
        } catch(Exception $e) {
            $db->rollback();
            throw $e;
        }
    }
}
