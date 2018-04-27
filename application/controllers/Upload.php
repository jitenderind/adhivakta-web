<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	}
	
	public function upload_file($folder)
	{
	    $status = "";
	    $msg = "";
	    $file_element_name = 'file';
	
	    if ($status != "error")
	    {
	        $this->load->helper('url');
	        $config['upload_path'] = './assets/user_data/'.$folder.'/';
	        $config['file_name']=time();
	        $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf|docx';
	        $config['max_size'] = 1024 * 20;
	        $config['encrypt_name'] = FALSE;
	        
	        if (!is_dir($config['upload_path'])) {
	            mkdir($config['upload_path'], 0775, TRUE);
	        }
	
	        $this->load->library('upload', $config);
	        if (!$this->upload->do_upload($file_element_name))
	        {
	            $status = 'error';
	            $msg = $this->upload->display_errors();
	            $msg .= $config['upload_path'];
	            echo json_encode(array('status'=>'Error','msg'=>$msg));
	        }
	        else
	        {
	            $data = $this->upload->data();
	            $image_path = $data['full_path'];
	            if(file_exists($image_path))
	            {
	                $status = "success";
	                $msg = "File successfully uploaded";
	            }
	            else
	            {
	                $status = "error";
	                $msg = "Something went wrong when saving the file, please try again.";
	            }
	            echo json_encode(array('status' => $status, 'msg' => $msg,'file_name'=>$data['orig_name']));
	        }
	        @unlink($_FILES[$file_element_name]);
	    } else {
	        echo json_encode(array('status'=>'Error'));
	    }
	    
	}
}