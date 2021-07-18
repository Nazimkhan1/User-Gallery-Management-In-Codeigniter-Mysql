<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		
		$this->load->helper("url");
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->load->library("session");
		$this->load->model("Category_model");
		
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
		    $result['categories'] = $this->Category_model->get_category();
			$this->load->view('admin/helpers/header_view',$result);
		    $this->load->view('admin/helpers/navbar_view');
		    $this->load->view('admin/category/category_list_view',$result);
		    $this->load->view('admin/helpers/footer_view');
	}
	public function addCategory()
	{       if ($this->session->userdata('user_id')!=''){
               $user_id = $this->session->userdata('user_id');
		    } 
			$result['userRow'] = $this->Admin_model->get_user_by_id($user_id);
		    $this->load->view('admin/helpers/header_view',$result);
		    $this->load->view('admin/helpers/navbar_view');
		    $this->load->view('admin/category/category_add_view');
		    $this->load->view('admin/helpers/footer_view');
	}
	
	public function saveCategory()
	{
		if ($this->session->userdata('user_id')!=''){
               $user_id = $this->session->userdata('user_id');
		    } 
		$result['userRow'] = $this->Admin_model->get_user_by_id($user_id);
		$category_name = $this->input->post('category_name');
		$category_detail = $this->input->post('category_detail');
		
		$this->form_validation->set_rules('category_name', 'Category Name', 'required');
		$this->form_validation->set_rules('category_detail', 'Category Detail', 'required');
        if($_FILES['category_image']['name']=='')
		{
			$this->form_validation->set_rules('category_image', 'Category Image', 'required');
		}
		if ($this->form_validation->run() == FALSE)
			{
				
				$this->load->view('admin/helpers/header_view',$result);
				$this->load->view('admin/helpers/navbar_view');
				$this->load->view('admin/category/category_add_view');
				$this->load->view('admin/helpers/footer_view');
			}
		else{
             
                $category_img='';
				if($_FILES['category_image']['name']!='')
				{
					
				$config['file_name'] = false;
				$config['error']   = false;
				$config['allowed_types'] = '*';
				$config['upload_path'] = 'images/articles/';
				$config['encrypt_name'] = true;
				$config['remove_spaces'] = true;

				$this->load->library('upload', $config);
				$field_name = "category_image";

				if($this->upload->do_upload($field_name)){
				$upload_data    = $this->upload->data();
				$category_img           = $upload_data['file_name'];
				}
					
				}
            $save['category_name']= $category_name;
			$save['category_detail']= $category_detail;
			$save['category_image']= $category_img;
			$save['added_by']= $user_id;
			//print_r($save); exit;
			$this->Category_model->save_category($save);
		    $this->session->set_flashdata('message', 'Category Added Successfully.');
			redirect(base_url().'Category/','refresh'); 			
			
		}
	}
	
	
	
	
	public function saveupdateCategory($id = FALSE)
	{
		if ($this->session->userdata('user_id')!=''){
               $user_id = $this->session->userdata('user_id');
		    } 
		$result['userRow'] = $this->Admin_model->get_user_by_id($user_id);
		$category_name = $this->input->post('category_name');
		$category_detail = $this->input->post('category_detail');
		
		$this->form_validation->set_rules('category_name', 'Category Name', 'required');
		if($_FILES['category_image']['name']=='' && $this->input->post('category_image_old')=='')
		{
			$this->form_validation->set_rules('category_image', 'Category Image', 'trim|required');
		}
		$this->form_validation->set_rules('category_detail', 'Category Detail', 'required');
        $result['categoryRow'] = $this->Category_model->get_category_by_id($id);
		if ($this->form_validation->run() == FALSE)
			{
				
			$this->load->view('admin/helpers/header_view',$result);
		    $this->load->view('admin/helpers/navbar_view');
            $this->load->view('admin/category/category_update_view',$result);
            $this->load->view('admin/category/category_add_view');
            $this->load->view('admin/helpers/footer_view');
			}
		else{
             // print_r($_FILES['category_image']['name']); exit;
                $category_img='';
				if($_FILES['category_image']['name']!='')
				{
					
				$config['file_name'] = false;
				$config['error']   = false;
				$config['allowed_types'] = '*';
				$config['upload_path'] = 'images/articles/';
				$config['encrypt_name'] = true;
				$config['remove_spaces'] = true;

				$this->load->library('upload', $config);
				$field_name = "category_image";

				if($this->upload->do_upload($field_name)){
				$upload_data    = $this->upload->data();
				$category_img           = $upload_data['file_name'];
				}
					
				}

				else{
				$category_img = $this->input->post('category_image_old');
			    
				}
			
			$save['id']= $id;
			$save['category_name']= $category_name;
			$save['category_detail']= $category_detail;
			$save['category_image']= $category_img;
			$save['added_by']= $user_id;
			//print_r($save); exit;
			$this->Category_model->save_category($save);
		    $this->session->set_flashdata('message', 'Category Added Successfully.');
			redirect(base_url().'Category/','refresh'); 			
			
		}
	}
	
	
	
	
	
	
	
	public function updateCategory($id)
	{       
	        if ($this->session->userdata('user_id')!=''){
               $user_id = $this->session->userdata('user_id');
		    } 
		    $result['userRow'] = $this->Admin_model->get_user_by_id($user_id);
	        $result['categoryRow'] = $this->Category_model->get_category_by_id($id);
		    $this->load->view('admin/helpers/header_view',$result);
		    $this->load->view('admin/helpers/navbar_view');
		    $this->load->view('admin/category/category_update_view',$result);
		    $this->load->view('admin/helpers/footer_view');
	}
	public function deleteCategory($id)
	{
		 $this->Category_model->delete_category_by_id($id);
		 $this->session->set_flashdata('message', 'Category Deleted Successfully.');
		 redirect(base_url().'Category','refresh');
	}
	
}
