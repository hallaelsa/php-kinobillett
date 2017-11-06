<?php
class dbService {
    private $db;
    
    public function __construct($host, $username, $password, $database) {
        $db = new mysqli($host, $username, $password, $database);
        //$db->autocommit(false);

        if($db->connect_error) {
            die("kunne ikke koble til database: ".$db->connect_error);
        }
        
        $this->db = $db;
    }
    
    public function queryArray($query) {
        $result = $this->db->query($query);        
        $rows = array();
        for($i = 0; $i < $this->db->affected_rows; $i++) {
            $rows[] = $result->fetch_object();
       }

        return $rows;
    }
    
    public function query($query) {
        $result = $this->db->query($query);
        
        if ($result == null || $this->db->affected_rows == 0)
            return null;
        
        return $result->fetch_object();
    }
   
    
    public function insert($query) {
        $this->db->query($query);
        if(!($this->db->affected_rows == 0)){
        return $this->db->insert_id;
        } else {
            return false;
        }
    }
    
     //kun til opprettelse av databasen
    public function create($query) {
        return $this->db->query($query);
        
    }
}
