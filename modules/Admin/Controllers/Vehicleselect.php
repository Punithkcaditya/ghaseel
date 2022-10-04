<?php

namespace Modules\Admin\Controllers;
use Modules\Admin\Controllers\BaseController;

use App\Models\Cities as Cities_Model;
use App\Models\Cars_Db as Cars_Db_Model;
use App\Models\Brands_Db as Brands_Db_Model;
use App\Models\Brand_Vehicletype_link_Db as Brand_Vehicletype_link_Db_Model;
use App\Models\Year_Model_brand_master_Db as Year_Model_brand_master_Db;
use App\Models\Models_db as Models_db;
use App\Models\Years_db as Years_db;

class Vehicleselect extends BaseController
{



    public function __construct()
    {

        $this->cities_model = new Cities_Model;
        $this->cars_db_model = new Cars_Db_Model;
        $this->brands_db_model = new Brands_Db_Model;
        $this->models_db_model = new Models_db;
        $this->brand_vehicletype_link_db_model = new Brand_Vehicletype_link_Db_Model;
        $this->year_model_brand_master_db_model = new Year_Model_brand_master_Db;
        $this->years_db_model = new Years_db;
        $this->request = \Config\Services::request();
        helper(['form', 'url', 'string']);
       
    }
        
    public function index()
    {
        helper('cookie');
        $data['cities'] = $this->cities_model->viewcities();
        $data['cars'] = $this->cars_db_model->orderBy('id', 'DESC')->findAll();
        // echo '<pre>';
        // print_r($data['cars']);
        // exit;
        return view('Modules\Admin\Views\pages\frontend\index',  $data);
     
    }

    public function brands($id = '')
    {
        helper('cookie');
        $myArray = array();
        try {
        $data['brand-vehicles'] =  $this->brand_vehicletype_link_db_model->get_brand_vehicle($id);
        foreach ($data['brand-vehicles'] as $key => $value) { 
        $myArray = explode (",", $value->differentbrands); 
        }
      
        $data['brands'] = $this->brands_db_model->getinarray($myArray);
      // echo '<pre>';
      // print_r($data['brands']);
      // exit;
        $data['cities'] = $this->cities_model->viewcities();
      }
      catch (\Exception $e) {
        $data['brands'] = 0;
        return view('Modules\Admin\Views\pages\frontend\brand1',  $data);
    }
        return view('Modules\Admin\Views\pages\frontend\brand1',  $data);
    }


    public function locate(){
        if ($this->request->getMethod() == 'post') {
            extract($this->request->getPost());
        helper("cookie");
      
        set_cookie("location", "$product_name", 36000);
        //delete_cookie("location");
        return   get_cookie("location");
        }

         // remove cookie value 
    }



    
    public function makestore(){
      if ($this->request->getMethod() == 'post') {
          extract($this->request->getPost());
      helper("cookie");
    
      set_cookie("make_name", "$make_name", 36000);
      //delete_cookie("location");
      return   get_cookie("make_name");
      }

       // remove cookie value 
  }





  public function brandstore(){
    if ($this->request->getMethod() == 'post') {
        extract($this->request->getPost());
    helper("cookie");
  
    set_cookie("brandname", "$brandname", 36000);
    //delete_cookie("location");
    return   get_cookie("brandname");
    }

     // remove cookie value 
}





public function modelstore(){
  if ($this->request->getMethod() == 'post') {
      extract($this->request->getPost());
  helper("cookie");

  set_cookie("modelname", "$modelname", 36000);
  //delete_cookie("location");
  return   get_cookie("modelname");
  }

   // remove cookie value 
}




public function yearstore(){
  if ($this->request->getMethod() == 'post') {
      extract($this->request->getPost());
  helper("cookie");

  set_cookie("yearname", "$yearname", 36000);
  //delete_cookie("location");
  return   get_cookie("yearname");
  }

   // remove cookie value 
}






    public function models($id = '') { 
      helper('cookie');
      $wholemodelids = array();
      $mymodelids = array();
      try {
      $data['cities'] = $this->cities_model->viewcities();
      $data['brand_models'] =  $this->year_model_brand_master_db_model->get_brand_vehicle($id);
     
      foreach ($data['brand_models'] as $key => $value) { 
        $wholemodelids = explode (",", $value->differentmodels); 
        }
        $mymodelids =  array_unique($wholemodelids);
      
        $data['models'] = $this->models_db_model->getinarray($mymodelids);
        // echo '<pre>';
        // print_r(   $data['models']);
        // exit;
      }  
       catch (\Exception $e) {
        $data['models'] = 0;
        return view('Modules\Admin\Views\pages\frontend\model',  $data);
    }
      return view('Modules\Admin\Views\pages\frontend\model',  $data);
      }





// year


public function years($id = '') { 

  helper('cookie');
  $wholeyearsids = array();

 
  try {
    $data['cities'] = $this->cities_model->viewcities();
    $data['years_id'] = $this->year_model_brand_master_db_model->get_years_id($id);
    foreach ($data['years_id'] as $key => $value) { 
      $wholeyearsids = explode (",", $value->differentyears); 
      }
      $myyearids =  array_unique($wholeyearsids);
    
    $data['years'] = $this->years_db_model->getinarray($myyearids);
  
  } catch (\Exception $e) {
    $data['years'] = 0;
    return view('Modules\Admin\Views\pages\frontend\year',  $data);
}
  return view('Modules\Admin\Views\pages\frontend\year',  $data);

}




public function customerinfo(){
  helper('cookie');
  $data['make_name'] =   get_cookie("make_name");
  $data['modelname'] =   get_cookie("modelname");
  $data['brandname'] =   get_cookie("brandname");
  $data['yearname'] =   get_cookie("yearname");
  $data['cities'] = $this->cities_model->viewcities();



  return view('Modules\Admin\Views\pages\frontend\customerinfo',  $data);
}









}