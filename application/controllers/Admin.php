<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		
		$this->load->helper("url");
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->load->library("session");
		$this->load->model("Admin_model");
		if ($this->session->userdata('admin_login') == 1){
           return true;
		}   
		 else{
		     redirect(base_url() . 'Login', 'refresh');
            }
	}

	public function index()
	{
		    if ($this->session->userdata('user_id')!=''){
               $user_id = $this->session->userdata('user_id');
		    } 
			$result['userRow'] = $this->Admin_model->get_user_by_id($user_id);
		    $this->load->view('admin/helpers/header_view',$result);
		    $this->load->view('admin/helpers/navbar_view');
		    $this->load->view('admin/admin_dashboard_view');
		    $this->load->view('admin/helpers/footer_view');
	}
	
	
	
}
