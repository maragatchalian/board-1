<?php 
class Thread extends AppModel
{
    //Minimum Length Values
    const MIN_TITLE_LENGTH = 1;

    //Maximum Length Values
    const MAX_TITLE_LENGTH = 30;

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

        $db = DB::conn();
        
        $date_created = date("Y-m-d H:i:s");
        
        try {
            $db->begin();
            $db->insert(
                'thread', array(
                    'user_id'=>$_SESSION['user_id'],
                    'title' => $this->title, 
                    'created' => $date_created
                    )
                );

            $this->id = $db->lastInsertId();
            //set the new thread id

            $this->write($comment);
            //write comment at the same time
        
            $db->commit();

        }catch (Exception $e) {
            $db->rollback();
        }
    }

    public static function getAll($offset, $limit)
    {
        $threads = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM thread LIMIT {$offset}, {$limit}");

        foreach($rows as $row) {
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

    public function write(Comment $comment)
    {
        if(!$comment->validate()) {
            throw new ValidationException('invalid comment');
        }

        $db = DB::conn();

        $date_created = date("Y-m-d H:i:s");
        
        try {
            $db->begin();
            $db->insert(
                'comment', array(
                    'thread_id' => $this->id, 
                    'user_id' => $_SESSION['user_id'],
                    'body' => $comment->body,
                    'created' => $date_created
                    )
                );
            $db->commit();
        
        }catch (Exception $e) {
            $db->rollback();
        }
    }

    public function is_user_thread()
    {
        return $this->user_id === $_SESSION['user_id'];
    }

    public function delete()
    {
        try {
            $db = DB::conn();
            $db->begin();
            $db->query('DELETE FROM thread WHERE id = ?', array($this->id));
            $db->commit();
            } catch (Exception $e) {
            $db->rollback();
        }

        redirect(url('thread/index'));
    }

    public function follow()
    {
         try {
            $db = DB::conn();
            $db->begin();
            $db->insert('follow', array('thread_id' => $this->id , 'user_id' => $_SESSION['user_id'] ));
            $db->commit();
            } catch (Exception $e) {
            $db->rollback();
        }

        redirect(url('thread/view', array('thread_id' => $this->id)));
    }

    public function unfollow()
    {
         try {
            $db = DB::conn();
            $db->begin();
            $db->query('DELETE FROM follow WHERE thread_id = ? && user_id = ?', array($this->id, $_SESSION['user_id']));
            $db->commit();
            } catch (Exception $e) {
            $db->rollback();
        }

        redirect(url('thread/view', array('thread_id' => $this->id)));

        
    }

    public function is_followed_thread()
    {
        $db = DB::conn();
        $followed_thread = $db->row('SELECT * FROM follow WHERE thread_id = ? && user_id = ?', array($this->id, $_SESSION['user_id']));
        
        return !$followed_thread;
    }
}
