<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class Brand_Vehicletype_link_Db extends Model {


    protected $table            = 'brand_vehicletype_link';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['brand_id', 'vehicle_type_id',   'created_at'];
    public $data;
    protected $db;
    function __construct() {
        parent::__construct();
        $this->db = Database::connect();
        $this->table = 'brand_vehicletype_link';
        $this->primary_key = array();
        $this->data = array();
       
    }




    public function get_brand_vehicle($id){
        $sql5 = 'SELECT DISTINCT  *,  GROUP_CONCAT(brand_id) as differentbrands   FROM '.$this->table .'  where vehicle_type_id = '.$id.'';

$query = $this->db->query($sql5);
$result = $query->getResultObject();

return $result;

    }










}