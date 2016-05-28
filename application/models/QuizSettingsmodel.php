<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuizSettingsmodel extends CI_Model {

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
	

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    
    
    function get_quizzes_count(){
    
		$this->db->from('quizzes');
		return $this->db->count_all_results();
    
    }
    
    function get_all_settings()
    {
    
    	
        $query = $this->db->get('app_settings');
        return $query->result_array();
    }
    
    function get_quizzes($limit,$start)
    {
    
    	$this->db->limit($limit,$start);
        $query = $this->db->get('quizzes');
        return $query->result_array();
    }

    function insert_entry()
    {
    
		$data = array(
			'id' => '',
		   'title' => $_POST['title'] ,
		   'description' => $_POST['description'] ,
		   'created_date' => Date("YYYY-mm-dd hh:dd:ss",time())
		);

		$this->db->insert('app_settings', $data); 

        
    }

    function update_entry($data, $id)
    {
    
		
		$this->db->where('id', $id);
		$this->db->update('app_settings', $data); 

        
    }
    
    function delete($id){
    
    	$this->db->where('id', $id);
		$this->db->delete('app_settings'); 
    
    }

}

