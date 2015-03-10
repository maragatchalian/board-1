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

        return (int) $db->value("SELECT COUNT(*) FROM comment WHERE 
                                  thread_id = ? ", array($thread_id));
  }

  public static function getAll($offset, $limit, $thread_id)
  {
        $comments = array();
        $db = DB::conn();

        $rows = $db->rows("SELECT * FROM comment WHERE 
                            thread_id = ? ORDER BY 
                            created ASC LIMIT {$offset}, {$limit}", 
                            array($thread_id));

        foreach ($rows as $row) {
          $comments[] = new self($row);
        }
       
        return $comments;
  }

  public static function get($id)
  {
      $db = DB::conn();

      $row = $db->row('SELECT * FROM comment WHERE id = ?', array($id));

      if (!$row) {
          throw new RecordNotFoundException('no record found');
      }

      return new self($row);
  }

  public function delete()
  {
    try {
      $db = DB::conn();

      $db->begin();
      
      $db->query('DELETE FROM comment WHERE id = ?', array($this->id));
      
      $db->commit();

    } catch (Exception $e) {
      $db->rollback();
    }
  }

  public function isUserComment()
  {
    return $this->user_id === $_SESSION['user_id'];
  }

  public function likes()
  {
    try {
      $db = DB::conn();

      $db->begin();

      $params = array(
                  'comment_id' => $this->id, 
                  'user_id' => $_SESSION['user_id'] 
                  );

      $db->insert('likes', $params);

      $db->commit();

    } catch (Exception $e) {
      $db->rollback();
    }   
  }

  public function unlikes()
  {
    try {
      $db = DB::conn();

      $db->begin();

      $params = array(
                  $this->id, 
                  $_SESSION['user_id']
                  );

      $db->query('DELETE FROM likes WHERE
                  comment_id = ? && user_id = ?', $params);
      
      $db->commit();

    } catch (Exception $e) {
      $db->rollback();
    }
  }

  public function isCommentLiked()
  {
    $db = DB::conn();

    $params = array(
                  $this->id, 
                  $_SESSION['user_id']
                  );
    
    $comment_liked = $db->row('SELECT * FROM likes WHERE 
                              comment_id = ? && user_id = ?', $params);
    
    return !$comment_liked;
  }

  public function countLikes()
  {
    $db = DB::conn();

    $total_likes = $db->value('SELECT COUNT(*) FROM likes WHERE 
                              comment_id =?', array($this->id));

    return $total_likes;
  }

  public static function getMostLiked()
  {
    $comment = array();

    $db = DB::conn();

    $rows = $db->rows("SELECT id, comment_id, user_id, COUNT(comment_id) 
                        AS total_likes
                        FROM likes GROUP BY comment_id 
                        ORDER BY total_likes DESC LIMIT 10;");

    foreach($rows as $row) {
      $comment[] = new self($row);
    }

    return $comment;           
  }

  public function getThreadId()
  {
    $db = DB::conn();

    $thread_id = $db->row('SELECT thread_id FROM 
                            comment WHERE id = ?', array($this->comment_id));

    return implode($thread_id);
  }

  public function getCommentSnippet()
  {
    $db = DB::conn();

    $comment_body = $db->row('SELECT body FROM comment WHERE id = ?', 
                              array($this->comment_id));

    $comment_snippet = substr(implode($comment_body), 0, 30) . "..." ;

    return $comment_snippet;
  }
}


