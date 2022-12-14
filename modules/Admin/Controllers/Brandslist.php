<?php

namespace Modules\Admin\Controllers;



use App\Models\Admin_Users as Admin_Users_Model;
use App\Models\Admin_Roles as Admin_Roles_Model;
use App\Models\Admin_Menuitems as Admin_Menuitems_Model;
use App\Models\Admin_Roles_Accesses_Model as Admin_Roles_Accesses_Model;
use App\Models\Admin_Users_Accesses_Model as Admin_Users_Accesses_Model;
use App\Models\Settings_Model as Settings_Model;
use App\Models\Brands_Db as Brands_Db_Model;
use App\Models\Cars_Db as Cars_Db_Model;
use App\Models\Brand_Vehicletype_link_Db as Brand_Vehicletype_link_Db_Model;


class Brandslist extends BaseController
{


    public function __construct()
    {

        $this->admin_users_model = new Admin_Users_Model;
        $this->admin_roles_model = new Admin_Roles_Model;
        $this->settings_model = new Settings_Model;
        $this->admin_roles_accesses_model = new Admin_Roles_Accesses_Model;
        $this->admin_users_accesses_model = new Admin_Users_Accesses_Model;
        $this->admin_menuitems_model = new Admin_Menuitems_Model;
        $this->brands_db_model = new Brands_Db_Model;
        $this->cars_db_model = new Cars_Db_Model;
        $this->brand_vehicletype_link_db_model = new Brand_Vehicletype_link_Db_Model;
    $this->request = \Config\Services::request();
    helper(['form', 'url', 'string']);
    }






    public function index()
    {

        $this->session = session();
        $this->data = ['session' => $this->session, 'request' => $this->request];
        $session = session();
        $data['user_data'] = [];
        $pot = json_decode(json_encode($session->get('userdata')) , true);
        if (empty($pot[0]))
        {
            return redirect()->to('/Auth/index');
        }
        else
        {
            $user_id = $pot[0]['user_id'];
            $role_id = $pot[0]['role_id'];
        }
        $this
            ->admin_roles_accesses_model->primary_key = array(
            'role_id' => $role_id
        );
        $this
            ->admin_users_model->primary_key = array(
            'user_id' => $user_id
        );
        $user_session_id = $this
            ->admin_users_model
            ->session_id();
        if (empty($user_id) && $this
            ->session
            ->userdata['logged_session_id'] != md5($user_session_id))
        {
            redirect('');
        }
        else
        {
            $side_menu_roles = $this
                ->admin_roles_accesses_model
                ->get_role_access($role_id);

            $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $side_menu_roles;
        }
        $data['session'] = $session;
        $data['title'] = 'Brand Details';
      
          
        // $data['breadcrumb'] = "<a href=User/$this->class_name>Roles</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add Role";
        $data['page_heading'] = 'Add New Brands';
        $data['request'] = $this->request;
        $data['menuslinks'] = $this
            ->request
            ->uri
            ->getSegment(1);
            $data['brands'] = $this->brands_db_model->orderBy('id', 'DESC')->findAll();
        //          echo '<pre>';
        // print_r($data);
        // exit;
        return view('Modules\Admin\Views\pages\brands\brandlist', $data);
    }



    public function addNewBrands()
    {
            $session = session();
            $data['user_data'] = [];
            $pot = json_decode(json_encode($session->get('userdata')), true);
            if (empty($pot[0])) {
                    return   redirect()->to('/Auth/index');
            } else {
                    $user_id = $pot[0]['user_id'];
                    $role_id = $pot[0]['role_id'];
            }

            $this->admin_users_model->primary_key = array('user_id' => $user_id);
            $user_session_id = $this->admin_users_model->session_id();
            if (empty($user_id) && $this->session->userdata['logged_session_id'] != md5($user_session_id)) {
                    redirect('');
            } else {
                    $side_menu_roles = $this->admin_roles_accesses_model->get_role_access($role_id);

                    $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $side_menu_roles;
            }
            $data['session'] = $session;
            $data['title'] = 'Add Brands';
            $data['pade_title'] = 'Admin Dashboard - Add brands';
            $data['roles'] = $this->admin_roles_model->orderBy('role_id', 'DESC')->findAll();
            $data['vehicle_type'] = $this->cars_db_model->orderBy('id', 'DESC')->findAll();
            
            // $data['breadcrumb'] = "<a href=User/$this->class_name>Roles</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add Role";
            $data['page_heading'] = 'Add New Brand';
            $data['request'] = $this->request;
            $data['menuslinks'] = $this->request->uri->getSegment(1);
            return view('Modules\Admin\Views\pages\brands\addnewbrands', $data);
    }




    public function savebrands()
    {

            $session = session();
            $data = [];
            $pot = json_decode(json_encode($session->get('userdata')), true);
            if (empty($pot[0])) {
                    return   redirect()->to('/Auth/index');
            } else {
                    $user_id = $pot[0]['user_id'];
                    $role_id = $pot[0]['role_id'];
            }

            $this->admin_users_model->primary_key = array('user_id' => $user_id);
            $user_session_id = $this->admin_users_model->session_id();
            if (empty($user_id) && $this->session->userdata['logged_session_id'] != md5($user_session_id)) {
                    redirect('');
            } else {
                    $side_menu_roles = $this->admin_roles_accesses_model->get_role_access($role_id);

                    $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $side_menu_roles;
            }


            helper(['form', 'url']);

          

     
            if ($this->request->getMethod() == 'post') {
                    extract($this->request->getPost());
            }

           
            $input = $this->validate(['brand_name' => 'required', 'vehicle_type' => 'required']);

            if (!empty($input))
            {
                $validated = $this->validate([
                        'file' => [
                                'uploaded[file]',
                                'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
                                'max_size[file,4096]',
                        ],
                ]);
            if (!empty($brand_id_hidd)) {
                    if ($validated) {
                            $avatar = $this->request->getFile('file');
                            //$avatar->move(WRITEPATH . 'uploads');

                            if ($avatar->isValid() && !$avatar->hasMoved()) {
                                    $name = $avatar->getName();
                                    $ext = $avatar->getClientExtension();
                                    $avatar->move('uploads/', $name);
                                    //$avatar->move(WRITEPATH . 'uploads', $name);
                                    $filepath = base_url()."/uploads/".$name;
                                    session()->setFlashdata('filepath', $filepath);
                                    session()->setFlashdata('extension', $ext);
                            }


                            $data = [

                                'avatar' =>  $avatar->getClientName(),
                                'image_type'  => $avatar->getClientMimeType(),
                                'make_name' => $brand_name,
                                'created_at' => date('Y-m-d'),
                            ];




                            $update = $this->brands_db_model->where('id', $brand_id_hidd)->set($data)->update();
                            if ($update) {
                                $delete = $this->brand_vehicletype_link_db_model->where('brand_id', $brand_id_hidd)->delete();
                                if ($delete) {
                                        foreach($vehicle_type as $row){
                                                $linkdata = [
                                                        'brand_id' =>  $brand_id_hidd,
                                                        'vehicle_type_id' => $row
                                                ];   
                                        $this->brand_vehicletype_link_db_model->save($linkdata);
                                        }

                                        $session->setFlashdata('success', 'Data has been updated');
                                }else{
                                        $session->setFlashdata('error', 'Failed to update');    
                                }
                            } else {
                                    $session->setFlashdata('error', 'Failed to update');
                            }
                    } else {
                            $data = [
                                    'make_name' => $brand_name,
                                    'created_at' => date('Y-m-d'),
                            ];
                       
                            $update = $this->brands_db_model->where('id', $brand_id_hidd)->set($data)->update();


                            if ($update) {
                                $delete = $this->brand_vehicletype_link_db_model->where('brand_id', $brand_id_hidd)->delete();
                                if ($delete) {
                                        foreach($vehicle_type as $row){
                                                $linkdata = [
                                                        'brand_id' =>  $brand_id_hidd,
                                                        'vehicle_type_id' => $row,
                                                        'created_at' => date('Y-m-d'),
                                                ];   
                                        $this->brand_vehicletype_link_db_model->save($linkdata);
                                        }

                                        $session->setFlashdata('success', 'Data has been updated');
                                }else{
                                        $session->setFlashdata('error', 'Failed to update');    
                                }
                                  
                            } else {
                                    $session->setFlashdata('error', 'Failed to update');
                            }
                    }
            } else {

                    if ($validated) {
                            $avatar = $this->request->getFile('file');
                            //$avatar->move(WRITEPATH . 'uploads');

                            if ($avatar->isValid() && !$avatar->hasMoved()) {


                                    $name = $avatar->getName();
                                    $ext = $avatar->getClientExtension();
                                    $avatar->move('uploads/', $name);
                                    //$avatar->move(WRITEPATH . 'uploads', $name);
                                    $filepath = base_url()."/uploads/".$name;

                                   
                                    // File path to display preview
                                   // $filepath = WRITEPATH . "uploads";

                                    session()->setFlashdata('filepath', $filepath);
                                    session()->setFlashdata('extension', $ext);
                            }


                            $data = [

                                    'avatar' =>  $avatar->getClientName(),
                                    'image_type'  => $avatar->getClientMimeType(),
                                    'make_name' => $brand_name,
                                    'created_at' => date('Y-m-d'),
                            ];

                            $save = $this->brands_db_model->insert_data($data);
                            if($save){

                                foreach($vehicle_type as $row){
                                        $linkdata = [
                                                'brand_id' =>  $save,
                                                'vehicle_type_id' => $row,
                                                'created_at' => date('Y-m-d'),
                                        ];   
                                $this->brand_vehicletype_link_db_model->save($linkdata);
                                }
                            }
                            $session->setFlashdata('success', 'File has been uploaded');
                    } else {
                            $session->setFlashdata('error', 'Please select a valid file');
                    }
            }
        }else{
                $session->setFlashdata('error', 'Enter All Fields');

        }
            
            return redirect('addNewBrands');
        
            
            // return redirect()->to(base_url('Modules\Admin\Views\pages\addnewcars'))->with('msg', $data);
    }




    public function brand_delete($id = '')
    {

            $session = session();
            $data['user_data'] = [];
            $pot = json_decode(json_encode($session->get('userdata')), true);
            // echo '<pre>';
            // print_r($pot[0]);
            // exit;
            if (empty($pot[0])) {
                    return   redirect()->to('/Auth/index');
            } else {
                    $user_id = $pot[0]['user_id'];
                    $role_id = $pot[0]['role_id'];
            }
            $delete = $this->brands_db_model->where('id', $id)->delete();
            if ($delete) {
                $deletetwo = $this->brand_vehicletype_link_db_model->where('brand_id', $id)->delete();
                if ($deletetwo) {
                    $session->setFlashdata('success', 'Brand Vehicle Link has been deleted successfully.');
                }else {
                        $session->setFlashdata('error', 'Brand Vehicle Link  Deletion failed due to unknown ID.');
                }
            } else {
                    $session->setFlashdata('error', 'Brand Deletion failed due to unknown ID.');
            }
            $this->admin_users_model->primary_key = array('user_id' => $user_id);
            $user_session_id = $this->admin_users_model->session_id();
            if (empty($user_id) && $this->session->userdata['logged_session_id'] != md5($user_session_id)) {
                    redirect('');
            } else {
                    $side_menu_roles = $this->admin_roles_accesses_model->get_role_access($role_id);

                    $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $side_menu_roles;
            }
            $data['session'] = $session;
        $data['title'] = 'Brand Details';      
        $data['page_heading'] = 'Add New Brands';
        $data['request'] = $this->request;
            $data['menuslinks'] = $this->request->uri->getSegment(1);
            $data['brands'] = $this->brands_db_model->orderBy('id', 'DESC')->findAll();
            $data['users'] = $this->admin_users_model->orderBy('user_id', 'ASCE')->findAll();
            $data['roles'] = $this->admin_roles_model->orderBy('role_id', 'ASCE')->findAll();
           // return view('Modules\Admin\Views\pages\brands\brandlist', $data);
            return redirect('brandslist');
    }




    public function brand_edit($id = '')
    {
            if ($id == null) {
                    return  redirect('Admindashboard');
            } else {
            
                    $this->global['pageTitle'] = 'Edit Brands';
                    $session = session();
                    $data['user_data'] = [];
                    $pot = json_decode(json_encode($session->get('userdata')), true);

                    if (empty($pot[0])) {
                            return   redirect()->to('/Auth/index');
                    } else {
                            $user_id = $pot[0]['user_id'];
                            $role_id = $pot[0]['role_id'];
                    }
                    $this->brands_db_model->primary_key = array('id' => $id);
                    $this->admin_users_model->primary_key = array('user_id' => $user_id);
                    $user_session_id = $this->admin_users_model->session_id();
                    if (empty($user_id) && $this->session->userdata['logged_session_id'] != md5($user_session_id)) {
                            redirect('');
                    } else {
                            $side_menu_roles = $this->admin_roles_accesses_model->get_role_access($role_id);

                            $_SESSION['sidebar_menuitems'] = (!empty($_SESSION['sidebar_menuitems'])) ? $_SESSION['sidebar_menuitems'] : $side_menu_roles;
                    }
                    $data['title'] = 'Edit Brands';
                    $data['session'] = $session;
                    $data['query'] = $this->brands_db_model->get_row($id);
                    $data['vehicle_type'] = $this->cars_db_model->orderBy('id', 'DESC')->findAll();
                    $data['roles'] = $this->admin_roles_model->orderBy('role_id', 'DESC')->findAll();
                    // $data['breadcrumb'] = "<a href=User/$this->class_name>Roles</a> &nbsp;&nbsp; > &nbsp;&nbsp; Add Role";
                    $data['page_heading'] = 'edit  Brand';
                    $data['request'] = $this->request;
                    $data['menuslinks'] = $this->request->uri->getSegment(1);
                //        echo '<pre>';
                //     print_r($data['query']);
                //     exit;
                    return view('Modules\Admin\Views\pages\brands\addnewbrands', $data);
            }
    }

}