<?php 
class Comment extends AppModel
{
   //Minimum Length Values
  const MIN_USERNAME_LENGTH = 1;
  const MIN_BODY_LENGTH = 1;

   //Maximum Length Values
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

  public static function countAll($thread_id)
  {
        $db = DB::conn();
        return (int) $db->value("SELECT COUNT(*) FROM comment WHERE thread_id = ? ", array($thread_id));
  }

  public static function getAll($offset, $limit, $thread_id)
  {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC LIMIT {$offset}, {$limit}", array($thread_id));
        foreach($rows as $row) {
        $comments[] = new Comment($row);
        }
        return $comments;
  }
}


