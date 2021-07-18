<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		    $this->load->view('admin/user/admin_profile_view',$result);
		    $this->load->view('admin/helpers/footer_view');
	}
	
	
	public function update_profile($id)
	{
		    $this->form_validation->set_rules('user_name',   'UserName',     'required'   ,array('required'=>'This field is required'));
		    $this->form_validation->set_rules('username', 'User Email',   'required'     ,array('required'=>'This field is required'));
		    $this->form_validation->set_rules('user_contact_number', 'Mobile Number', 'required'     ,array('required'=>'This field is required'));
		    $this->form_validation->set_rules('about_us', 'About Us', 'required'     ,array('required'=>'This field is required'));
			
			if($_FILES['profile_image']['name']=='' && $this->input->post('profile_image_old')=='')
			{
			$this->form_validation->set_rules('profile_image', 'Profile Image', 'required'     ,array('required'=>'This field is required'));
			} 
			$this->form_validation->set_error_delimiters('<div style="margin-top:2px; color:red; font-size:12px;">', '</div>');
			$this->form_validation->set_message('required', ' %s required');
		if ($this->form_validation->run() == FALSE)
		{
			
			if ($this->session->userdata('user_id')!=''){
               $user_id = $this->session->userdata('user_id');
		    } 
			$result['userRow'] = $this->Admin_model->get_user_by_id($user_id);
		    $this->load->view('admin/helpers/header_view',$result);
		    $this->load->view('admin/helpers/navbar_view');
		    $this->load->view('admin/user/admin_profile_view',$result);
		    $this->load->view('admin/helpers/footer_view');
		}
		else{
			
			
			     $aimage='';
				if($_FILES['profile_image']['name'] !='')
				{
					
				$config['file_name'] = false;
				$config['error']   = false;
				$config['allowed_types'] = '*';
				$config['upload_path'] = 'images/articles/';
				$config['encrypt_name'] = true;
				$config['remove_spaces'] = true;

				$this->load->library('upload', $config);
				$field_name = "profile_image";

				if($this->upload->do_upload($field_name)){
				$upload_data    = $this->upload->data();
				$aimage           = $upload_data['file_name'];
				}
					
				}
				else{
				$aimage = $this->input->post('profile_image_old');
			    
				}
				
			$update['user_name']             = $this->input->post('user_name');
			$update['username']           = $this->input->post('username');
			$update['user_contact_number']             = $this->input->post('user_contact_number');
			$update['about_us']              = $this->input->post('about_us');
			$update['profile_image']           = $aimage;	
		    $this->Admin_model->update_profile($update,$id);
			$this->session->set_flashdata('message', '<span style="color:green;">Your profile successfully updated.</span>');
			redirect(base_url().'Profile'); 
			
			
		}
    }
	
	
	
	
	
	
}
