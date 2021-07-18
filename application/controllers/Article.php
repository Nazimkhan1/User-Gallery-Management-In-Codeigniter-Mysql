<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		
		$this->load->helper("url");
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->load->library("session");
		$this->load->model("Article_model");
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
		    $result['articles'] = $this->Article_model->get_article();
			$this->load->view('admin/helpers/header_view',$result);
		    $this->load->view('admin/helpers/navbar_view');
		    $this->load->view('admin/articles/article_list_view',$result);
		    $this->load->view('admin/helpers/footer_view');
	}
	public function addArticle()
	{       if ($this->session->userdata('user_id')!=''){
               $user_id = $this->session->userdata('user_id');
		    } 
			$result['userRow'] = $this->Admin_model->get_user_by_id($user_id);
			$result['categories'] = $this->Category_model->get_category();
		    $this->load->view('admin/helpers/header_view',$result);
		    $this->load->view('admin/helpers/navbar_view');
		    $this->load->view('admin/articles/article_add_view',$result);
		    $this->load->view('admin/helpers/footer_view');
	}
	public function saveArticle()
	{
		if ($this->session->userdata('user_id')!=''){
               $user_id = $this->session->userdata('user_id');
		    } 
		$result['userRow'] = $this->Admin_model->get_user_by_id($user_id);
		$result['categories'] = $this->Category_model->get_category();
		$article_title = $this->input->post('article_title');
		$category_id = $this->input->post('category_id');
		$article_details = $this->input->post('article_details');
		
		
		$this->form_validation->set_rules('category_id', 'Category Name', 'required');
		$this->form_validation->set_rules('article_title', 'Article Title', 'required');
		$this->form_validation->set_rules('article_details', 'Article Details', 'required');
		if($_FILES['article_image']['name']==''){
			$this->form_validation->set_rules('article_image', 'Article Image', 'trim|required');
		}
		//print_r($_FILES['article_image']['name']); exit;
		if ($this->form_validation->run() == FALSE)
			{
				
			$this->load->view('admin/helpers/header_view',$result);
		    $this->load->view('admin/helpers/navbar_view');
		    $this->load->view('admin/articles/article_add_view');
		    $this->load->view('admin/helpers/footer_view');
			}
		else{
			//print_r($_FILES['article_image']['name']); exit;
			    $aimage='';
				if(!empty($_FILES['article_image']['name']))
				{
					$config['file_name'] = false;
					$config['error']   = false;
					$config['allowed_types'] = '*';
					$config['upload_path'] = 'images/articles/';
					$config['encrypt_name'] = true;
					$config['remove_spaces'] = true;

					$this->load->library('upload', $config);
					$field_name = "article_image";

					if($this->upload->do_upload($field_name)){
					$upload_data    = $this->upload->data();
					$aimage           = $upload_data['file_name'];
				}
					
				}
			$save['category_id']= $category_id;
			$save['article_title']= $article_title;
			$save['article_image']= $aimage;
			$save['article_details']= $article_details;
			$save['added_by']= $user_id;
			//print_r($save); exit;
			$this->Article_model->save_article($save);
		    $this->session->set_flashdata('message', 'Article Added Successfully.');
			redirect(base_url().'Article','refresh'); 			
			
		}
	}
	
	public function saveupdateArticle($id)
	{
		//print_r($id); exit;
		if ($this->session->userdata('user_id')!=''){
               $user_id = $this->session->userdata('user_id');
		    } 
		$result['userRow'] = $this->Admin_model->get_user_by_id($user_id);
		$result['categories'] = $this->Category_model->get_category();
		$article_title = $this->input->post('article_title');
		$category_id = $this->input->post('category_id');
		$article_details = $this->input->post('article_details');
		
		$this->form_validation->set_rules('category_id', 'Category Name', 'required');
		$this->form_validation->set_rules('article_title', 'Article Title', 'required');
		$this->form_validation->set_rules('article_details', 'Article Details', 'required');
		if($_FILES['article_image']['name']=='' && $this->input->post('article_image_old')=='')
		{
			$this->form_validation->set_rules('article_image', 'Article Image', 'trim|required');
		}
		//print_r($_FILES['article_image']['name']); exit;
		
		$result['categoryRow'] = $this->Article_model->get_article_by_id($id);
		if ($this->form_validation->run() == FALSE)
			{
				
			$this->load->view('agent/helpers/header_view',$result);
		    $this->load->view('agent/helpers/navbar_view');
		    $this->load->view('agent/articles/article_update_view',$result);
		    $this->load->view('agent/helpers/footer_view');
			}
		else{
			//print_r($_FILES['article_image']['name']); exit;
			    $aimage='';
				if(!empty($_FILES['article_image']['name']))
				{
					
				$config['file_name'] = false;
				$config['error']   = false;
				$config['allowed_types'] = '*';
				$config['upload_path'] = 'images/articles/';
				$config['encrypt_name'] = true;
				$config['remove_spaces'] = true;

				$this->load->library('upload', $config);
				$field_name = "article_image";

				if($this->upload->do_upload($field_name)){
				$upload_data    = $this->upload->data();
				$aimage           = $upload_data['file_name'];
				}
					
				}
				else{
				$aimage = $this->input->post('article_image_old');
			    
				}
			
			
			
			
			$save['id']= $id;
			
			$save['category_id']= $category_id;
			$save['article_title']= $article_title;
			$save['article_image']= $aimage;
			$save['article_details']= $article_details;
			$save['added_by']= $user_id;
			//print_r($save); exit;
			$this->Article_model->save_article($save);
		    $this->session->set_flashdata('message', 'Article Updated Successfully.');
			redirect(base_url().'Article','refresh'); 			
			
		}
	}
	public function updateArticle($id)
	{       
	        if ($this->session->userdata('user_id')!=''){
               $user_id = $this->session->userdata('user_id');
		    } 
		    $result['userRow'] = $this->Admin_model->get_user_by_id($user_id);
	        $result['categories'] = $this->Category_model->get_category();
			$result['categoryRow'] = $this->Article_model->get_article_by_id($id);
			 
			//p($result['categoryRow']); exit;
			 //p($result['categories'] ); exit;
	       
		    $this->load->view('admin/helpers/header_view',$result);
		    $this->load->view('admin/helpers/navbar_view');
		    $this->load->view('admin/articles/article_update_view',$result);
		    $this->load->view('admin/helpers/footer_view');
	}
	public function deleteArticle($id)
	{
		 $this->Article_model->delete_article_by_id($id);
		 $this->session->set_flashdata('message', 'Article Deleted Successfully.');
		 redirect(base_url().'Article','refresh');
	}
	
}
