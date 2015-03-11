<?php 
class Thread extends AppModel
{
    //Minimum Length Values
    const MIN_TITLE_LENGTH = 1;
    //Maximum Length Values
    const MAX_TITLE_LENGTH = 30;
    const MAX_RANK = 10;


    public $validation = array(
    'title' => array(
        'length' => array(
            'validate_between', self::MIN_TITLE_LENGTH, self::MAX_TITLE_LENGTH),
        )
    );

    public function create(Comment $comment)
    {
        if (!$this->validate() || !$comment->validate()) {
            throw new ValidationException('Invalid thread or comment');
        }

        try {
            $db = DB::conn();
            $created = date("Y-m-d H:i:s");
            $db->begin();
            $params = array(
                'user_id'=>$_SESSION['user_id'],
                'title' => $this->title, 
                'created' => $created
            );
            $db->insert('thread', $params);
            //set the new thread id
            $this->id = $db->lastInsertId();
            //write comment at the same time
            $comment->write($comment, $this->id);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public static function getAll($offset, $limit)
    {
        $threads = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM thread LIMIT {$offset}, {$limit}");
        
        foreach ($rows as $row) {
            $threads[] = new self($row);
        }
        return $threads;
    }

    public static function countAll()
    {
        $db = DB::conn();
        return (int) $db->value("SELECT COUNT(*) FROM thread");
    }
    
    public static function get($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM thread WHERE id = ?', array($id));
        
        if (!$row) {
            throw new RecordNotFoundException('no record found');
        }
        return new self($row);
    }


    public function isUserThread()
    {
        return $this->user_id === $_SESSION['user_id'];
    }

    public function delete()
    {
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                $this->id,
                $_SESSION['user_id']
            );
            $db->query('DELETE FROM thread WHERE id = ? && user_id = ?', $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }

    }

    public function addFollow()
    {
        try {            
            $db = DB::conn();
            $db->begin();
            $params = array(
                'thread_id' => $this->id,
                'user_id' => $_SESSION['user_id'] 
            );
            $db->insert('follow', $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public function removeFollow()
    {
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                $this->id, 
                $_SESSION['user_id']
            );
            $db->query('DELETE FROM follow WHERE 
                        thread_id = ? && user_id = ?', $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public function isFollowed()
    {
        $db = DB::conn();
        $params = array(
            $this->id,
            $_SESSION['user_id']
        );
        $followed_thread = $db->row('SELECT * FROM follow 
                                    WHERE thread_id = ? && user_id = ?', $params);
        return $followed_thread;
    }

    public function countFollow()
    {
        $db = DB::conn();
        $total_followers = $db->value('SELECT COUNT(*) FROM follow 
                                        WHERE thread_id =?', array($this->id));
        return $total_followers;
    }

    public static function getMostFollowed()
    {
        $threads = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT thread_id, COUNT(thread_id) AS total_followers
                        FROM follow GROUP BY thread_id 
                        ORDER BY total_followers DESC LIMIT " . self::MAX_RANK);

        foreach ($rows as $row) {
            $thread[] = new self($row);
        }
        return $thread;           
    }
    
    public static function getTitle($thread_id)
    {
        $db = DB::conn();
        $thread = $db->row("SELECT title FROM thread WHERE 
                            id = ?", array($thread_id));
        return $thread['title'];
    }
}
