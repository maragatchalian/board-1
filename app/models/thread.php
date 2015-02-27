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
    
     public function countComments()
    {
        $db = DB::conn();
        return (int) $db->value("SELECT COUNT(*) FROM comment WHERE thread_id = ? ", array($this->id));
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

     public function getComments($offset, $limit)
    {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC LIMIT {$offset}, {$limit}", array($this->id));
        foreach($rows as $row) {
        $comments[] = new Comment($row);
        }
        return $comments;
    }

    public function write(Comment $comment)
    {
        if(!$comment->validate()) {
            throw new ValidationException('invalid comment');
        }

        $db = DB::conn();
        
        try {
            $db->begin();
            $db->insert(
                'comment', array(
                    'thread_id' => $this->id, 
                    'username' => $comment->username, 
                    'body' => $comment->body
                    )
                );
            $db->commit();
        
        }catch (Exception $e) {
            $db->rollback();
        }
    }
}
