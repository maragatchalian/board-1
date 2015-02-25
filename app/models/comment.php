<?php 
    class Comment extends AppModel
    {
       //Minimum Length
       const MIN_USERNAME_LENGTH = 1;
       const MIN_BODY_LENGTH = 1;

       //Maximum Length
       const MAX_USERNAME_LENGTH = 20;
       const MAX_BODY_LENGTH = 200;

      public $validation = array(
           'username' => array(
                'length' => array(
                    'validate_between', self::MIN_USERNAME_LENGTH, self::MAX_USERNAME_LENGTH,
                ),
            ),  

            'body' => array(
                'length' => array(
                    'validate_between', self::MIN_BODY_LENGTH, self::MAX_BODY_LENGTH,
                ),
            ),
        );
    }
 ?>

