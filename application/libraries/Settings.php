<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings {

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
    
    private $CI;
    private $table;
    
	public function __construct()
	{
		$CI =& get_instance();
		$this->CI = $CI;
		$this->CI->load->database();
		$this->table='settings';
	}
	
	public function fetchSetting($key){
	    $this->CI->db->select('value');
	    $this->CI->db->where('key',$key);
	    $query = $this->CI->db->get($this->table);
	    $result = $query->first_row();
	    return $result->value;
	}
	
}