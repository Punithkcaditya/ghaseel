<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class Year_Model_brand_master_Db extends Model {


    protected $table            = 'year_brand_make_link';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['make_id', 'model_id', 'year_id', 'created_at'];
    public $data;
    protected $db;
    function __construct() {
        parent::__construct();
        $this->db = Database::connect();
        $this->table = 'year_brand_make_link';
        $this->primary_key = array();
        $this->data = array();
       
    }




    public function get_brand_vehicle($id){
        $sql5 = 'SELECT DISTINCT  *,  GROUP_CONCAT(model_id) as differentmodels   FROM '.$this->table .'  where make_id = '.$id.'';
$query = $this->db->query($sql5);
$result = $query->getResultObject();
return $result;

    }


public function get_years_id($id){
    $sql6 = 'SELECT DISTINCT  *,  GROUP_CONCAT(year_id) as differentyears   FROM '.$this->table .'  where model_id = '.$id.'';
    
    $query = $this->db->query($sql6);
    $result = $query->getResultObject();
    return $result;
}





}