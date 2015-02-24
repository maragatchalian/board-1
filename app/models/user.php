<?php 
    Class User extends AppModel
    {   
        //Minimum Length  
        const MIN_USERNAME_LENGTH = 1;
        const MIN_FIRST_NAME_LENGTH = 1;
        const MIN_LAST_NAME_LENGTH = 1;
        const MIN_EMAIL_LENGTH = 1;
        const MIN_PASSWORD_LENGTH = 8;

        //Maximum Length
        const MAX_USERNAME_LENGTH = 20;
        const MAX_FIRST_NAME_LENGTH = 254;
        const MAX_LAST_NAME_LENGTH = 254;
        const MAX_EMAIL_LENGTH = 254;
        const MAX_PASSWORD_LENGTH = 20;


        public $validation = array(
            'username' => array(
                'length' => array(
                    'validate_between', self::MIN_USERNAME_LENGTH, self::MAX_USERNAME_LENGTH,
                ),

                'exist' => array(
                    'is_username_exist',                         )
                ),
                    

            'first_name' => array(
                'length' => array(
                    'validate_between', self::MIN_FIRST_NAME_LENGTH, self::MAX_FIRST_NAME_LENGTH,
                ),
            ),

            'last_name' => array(
                'length' => array(
                    'validate_between', self::MIN_LAST_NAME_LENGTH, self::MAX_LAST_NAME_LENGTH,
                ),
            ),

            'email' => array(
                'length' => array(
                    'validate_between', self::MIN_EMAIL_LENGTH, self::MAX_EMAIL_LENGTH,
                ),
            ),

            'password' => array(
                'length' => array(
                    'validate_between', self::MIN_PASSWORD_LENGTH, self::MAX_PASSWORD_LENGTH,
                ),
                'correct' => array(
                    'is_correct_user',
                )
            ),

            'confirm_password' => array(
                'length' => array(
                    'validate_between', self::MIN_PASSWORD_LENGTH, self::MAX_PASSWORD_LENGTH,
                ),
                 'match' => array(
                    'is_password_match',                 
                ),
            ),
        );

        public function register()
        {
            $this->validate();

            if ($this->hasError()) {
                throw new ValidationException('Invalid user credentials');
            }

            $db = DB::conn();
            
            $params = array(
                'username'   => $this->username,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => md5($this->password)
                );

            try {
                $db->begin();
                $db->insert('user', $params);
                $db->commit();
            }catch(Exception $e) {
                $db->rollback();
                throw $e;
            }
        }

        public function login()
        {
            $this->validate();

            if ($this->hasError()) {
                throw new ValidationException('Invalid Username or Password');
            }

            $db = DB::conn();
            $_SESSION['user_id'] = $db->row("SELECT id FROM user WHERE username =?", array($this->username));
            
        }

        public function is_password_match()
        {
            return $this->password == $this->confirm_password;
        }

        public function is_username_exist()
        {
            $db = DB::conn();
            $username_exist = $db->row("SELECT username FROM user WHERE username = ?", array($this->username));

            return (!$username_exist);
        }

        public function is_correct_user()
        {
            $db = DB::conn();
            $params = array(
                'username' => $this->username,
                'password' => md5($this->password) 
            );
            $correct_user = $db->row("SELECT username, password FROM user WHERE username = :username && password = :password", $params);
            
            return !$correct_user;
        }
    }
