<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		$this->load->helper("url");
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->load->library("session");
	}

	public function index()
	{
		
		 if ($this->session->userdata('admin_login') == 1)
                redirect(base_url() . 'Admin', 'refresh');
		 else{
				$this->load->view('admin/login/admin_login_view');
		     }
	
	}
	public function authenticate()
	{
		$response = array();
		//Recieving post input of email, password from ajax request
		$email 		= $this->input->post('email');
		$password 	= $this->input->post('password');
		$this->form_validation->set_rules('email', 'User name', 'required');
		$this->form_validation-> set_rules('password', 'Password', 'required');
		$this->form_validation->set_error_delimiters('<div style="margin-top:2px; color:red; font-size:12px;">', '</div>');
		$this->form_validation->set_message('required', ' %s required');
		if ($this->form_validation->run() == False)
		{
			 $this->load->view('admin/login/admin_login_view');
		}
		else{
			//Validating login
		$login_status = $this->validate_login( $email , $password);
		$response['login_status'] = $login_status;
		if ($login_status == 'success') {
			$this->index();
		}
		}
	}
	//Validating login from ajax request
    private function validate_login($email	=	'' , $password	 =  '')
    {
		$credential	=	array('username' => $email , 'password' =>sha1($password));
		$query = $this->db->get_where('users' , $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
			$user_type=$row->user_type;
			if($user_type=='admin'){
				$this->session->set_userdata('user_id', $row->id);
				$this->session->set_userdata('admin_login', '1');
				$this->session->set_userdata('login_type', 'admin');
			}
			return 'success';
		}
		else{
			$this->data['login_error']='Invalid email or password.';
		    $this->load->view('admin/login/admin_login_view',$this->data);
		}
    }
	 function logout()
     {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('admin_login');
        $this->session->unset_userdata('login_type');
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'Logged out successfully');
        redirect('Login' , 'refresh');
     }
	 
	 public function forgot_password()
	 {
		 if($this->input->post('Submit'))
		 {
		
		 }
		 else
		 {
			$this->load->view('admin/login/admin_forgot_password_view');
		 }
	 }
	
	
}//end class
