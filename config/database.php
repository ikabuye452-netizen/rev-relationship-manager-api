<?php


class Database {
    private $db_file = __DIR__ . '/rev.sqlite';
    public $conn;

    public function __construct() {
        $this->conn = null;
        
    }

    public function connect()  {
        $dsn = "sqlite:" . $this->db_file;
        try{
            if($this->conn==null){
                $this->conn = new PDO($dsn,"","",array(
                    PDO::ATTR_PERSISTENT => true
                ));
            }
            return $this->conn;
        } catch(PDOException $e){
             error_log("[" . date("Y-m-d H:i:s") . "] Connection failed: " . $e->getMessage() );
            
        }
        }
}

