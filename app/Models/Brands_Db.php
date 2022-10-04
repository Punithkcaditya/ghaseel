<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class Brands_Db extends Model {

    protected $table            = 'brand';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['make_name', 'avatar', 'image_type',  'created_at'];
    protected $db;
    function __construct() {
        parent::__construct();
        $this->db = Database::connect();
        $this->table = 'brand';
        $this->primary_key = array();
        $this->data = array();
       
    }

 

    public function get_row($id){
        $sql4 = 'SELECT b.*, bv.vehicle_type_id,  GROUP_CONCAT(vehicle_type_id) as differentvehicles   FROM '.$this->table .' b LEFT JOIN brand_vehicletype_link bv on b.id = bv.brand_id where b.id = '.$id.'';
        //$sql3 = 'SELECT * FROM '.$this->table .' where id = '.$id.'';
        // echo '<pre>';
        // print_r( $sql4);
        // exit;
        $query = $this->db->query($sql4);
        $result = $query->getResultObject();
    
        return $result;
    }


       

    public function insert_data($data = array())
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
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