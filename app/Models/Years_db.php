<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class Years_db extends Model {


    protected $table            = 'year';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['year',  'created_at'];
    public $data;
    protected $db;
    function __construct() {
        parent::__construct();
        $this->db = Database::connect();
        $this->table = 'year';
        $this->primary_key = array();
        $this->data = array();
       
    }




 




    public function getinarray($data = array())
    {
       
        $List = implode(', ', $data);
        
                   $sql7 = 'SELECT * FROM '.$this->table .' where id in ('.$List.')'; 
            
                   $query = $this->db->query($sql7);
                   $result = $query->getResultObject();
                return $result;
    }





}