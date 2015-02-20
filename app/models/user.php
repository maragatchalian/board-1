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
            ),

            'confirm_password' => array(
                'length' => array(
                    'validate_between', self::MIN_PASSWORD_LENGTH, self::MAX_PASSWORD_LENGTH,
                ),
            ),
        );

        public function register()
        {
            $this->validate();

            if ($this->hasError()) {
                throw new ValidationException('Invalid user credentials');
            }

            $params = array(
                'username'   => $this->username,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => $this->password
            );

            $db = DB::conn();
            $db->insert('user', $params);
        }
    }