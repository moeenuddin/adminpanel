<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quizmodel extends CI_Model {

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
    
    function get_all_quizzes()
    {
    
    	
        $query = $this->db->get('quizzes');
        return $query->result_array();
    }
    
    function get_quizzes($limit,$start)
    {
    
    	$this->db->limit($limit,$start);
        $query = $this->db->get('quizzes');
        return $query->result_array();
    }
    
    function get_quiz($quizID)
    {
    
    	$this->db->where(id,$quizID);
        $query = $this->db->get('quizzes');
        return $query->result_array();
    }

    function insert_entry()
    {
    
		$data = array(
			'id' => '',
		   'title' => $_POST['title'] ,
		   'description' => $_POST['description'] ,
		   'created_date' => date("Y-m-d H:i:s")
		);

		$this->db->insert('quizzes', $data); 

        
    }

    function update_entry($id)
    {
    
		$data = array(
		   'title' => $_POST['title'] ,
		   'description' => $_POST['description'] ,
		   'created_date' => date("Y-m-d H:i:s")
				);

		$this->db->where('id', $id);
		$this->db->update('quizzes', $data); 

        
    }
    
    function delete($id){
    
    	$this->db->where('id', $id);
		$this->db->delete('quizzes'); 
    
    }

}

