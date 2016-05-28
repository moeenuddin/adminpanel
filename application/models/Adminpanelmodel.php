<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpanelmodel extends CI_Model {

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
    
    
    
    function get_scores_count(){
    
		$this->db->from('topusers');
		return $this->db->count_all_results();
    
    }
    
    function get_all_topusers()
    {
    
    	
        $query = $this->db->get('topusers');
        return $query->result_array();
    }
    
    function get_scores($limit,$start)
    {
    
    	$this->db->limit($limit,$start);
        $query = $this->db->get('topusers');
        return $query->result_array();
    }

    function insert_entry($data)
    {
    
		$data = array(
			'id' => '',
		   'user_id' => $data['ip'] ,
		   'user_name' => $data['name'] ,
		   'score' => $data['score'] ,
		    'created_date' => date("Y-m-d H:i:s")
		);

		$this->db->insert('topusers', $data); 

        
    }

    function update_entry()
    {
    
		$data = array(
		   'title' => $_POST['title'] ,
		   'description' => $_POST['description'] ,
		   'created_date' => Date("YYYY-mm-dd hh:dd:ss",time())
				);

		$this->db->where('id', $id);
		$this->db->update('topusers', $data); 

        
    }
    
    

}

