<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		
		$this->load->helper("url");
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->load->library("session");
		$this->load->model("Admin_model");
	}

	
	   public function change_password($id)
       {
	    
	    if($this->input->post('changePass'))
		{   
	                    $password = $this->input->post('password');
	                    if($password=='')
						{
							$this->form_validation->set_rules('password', 'Password', 'trim|required' ,array('required'=>'Please enter your old password'));
						}
                        else
						{
							 $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_old_pass' ,array('required'=>'Please enter your old password'));
						}
                        $this->form_validation->set_rules('new_password', 'New Password', 'required|callback_pass_format' ,array('required'=>'Please enter new password'));
		                $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'required|matches[new_password]' ,array('required'=>'Please enter confirm new password'));
						$result['userRow'] = $this->Admin_model->get_user_by_id($id);
						if($this->form_validation->run() == FALSE)
						{
							if ($this->session->userdata('user_id')!=''){
							$user_id = $this->session->userdata('user_id');
							} 
							$result['userRow'] = $this->Admin_model->get_user_by_id($id);
							$this->load->view('admin/helpers/header_view',$result);
							$this->load->view('admin/helpers/navbar_view');
							$this->load->view('admin/user/admin_profile_view',$result);
							$this->load->view('admin/helpers/footer_view');
						}
						else
						{
							 $email = $this->input->post('email');
							 $vc_password_new =  $this->input->post('new_password');
							 $password_hash = sha1($vc_password_new);
							 $update['password']= $password_hash;
				             $updated = $this->Admin_model->update_new_password($email,$update);
							 if(isset($updated) && $updated==1)
							 {
								$this->session->set_flashdata('message', '<span style="color:green;">Your new password successfully changed.</span>');
								redirect(base_url().'Forgot/change_password/'.$id); 	
							 }
							 else
							 {
								 $this->session->set_flashdata('message', '<span style="color:red;">Something went wrong.</span>');
								 redirect(base_url().'Forgot/change_password/'.$id); 		
							 }
	                  
						}
            
		}
		else{
		$result['userRow'] = $this->Admin_model->get_user_by_id($id);
		$this->load->view('admin/helpers/header_view',$result);
		$this->load->view('admin/helpers/navbar_view');
		$this->load->view('admin/user/admin_profile_view',$result);
		$this->load->view('admin/helpers/footer_view');
		}
   }
   
   function check_old_pass($password){
    $email = $this->input->post('email');
	$flag = $this->Admin_model->check_old_user_password($email,$password);

	if($flag!=1) {
	$this->form_validation->set_message('check_old_pass', 'Enter password does not match with current password.');
	return false;
	}else{
	return true;
	}

	}
	function pass_format($password){

	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	$specialChars = preg_match('@[^\w]@', $password);

	if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 6 || strlen($password) > 10) {
	$this->form_validation->set_message('pass_format', 'Password must be 6 to 10 characters long,including UPPER/lowercase and numbers');
	return false;
	}else{
	return true;
	}

	}
	
	
	
	
	
}//end class
