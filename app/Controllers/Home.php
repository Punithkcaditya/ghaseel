<?php

namespace App\Controllers;
use App\Models\Locations as Locations_Model;

class Home extends BaseController
{



    public function __construct()
    {
        $this->locations_model = new Locations_Model;

    }
        
    public function index()
    {
        return view('welcome_message');
    }


    public function depedentselect(){

        $request = service('request');
        helper(['form', 'url', 'validation']);
        $data = array();
  
   
        $postData = array(
                'city' => $this->request->getPost('city'),
            );
     
            $data = $this->locations_model->dependentdata($postData);
     
            echo json_encode($data);

       
    }
}
