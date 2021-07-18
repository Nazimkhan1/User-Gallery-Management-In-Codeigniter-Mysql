<?php
    
class MyFormController extends CI_Controller {
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
   public function __construct()
	{
		parent :: __construct();
		
		$this->load->helper("url");
		$this->load->helper("form");
		
	}
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index()
    {
        $this->load->view('myForm');
    } 
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function postImage()
    {
        $data = $_POST['image'];
		
     
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
     
        $data = base64_decode($data);
        $imageName = time().'.png';
        file_put_contents('upload/'.$imageName, $data);
     
        echo 'done';
    }
}