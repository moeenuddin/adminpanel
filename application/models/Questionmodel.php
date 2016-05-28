<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questionmodel extends CI_Model {

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
    
    
    function get_questions($limit, $start)
    {
    $this->db->limit($limit,$start);
        $query = $this->db->get('questions');
        return $query->result_array();
    }
    
    function get_question_count(){
    
    $this->db->from('questions');
		return $this->db->count_all_results();
    
    
    }
    
    function get_questionsforquiz($quiz)
    {
     $query =$this->db->query("SELECT * FROM questions WHERE quiz_id in (".$quiz.") ");
    	
        return $query->result_array();
    }
    
    function get_questionsWithIDs($csvQs)
    {
     $query =$this->db->query("SELECT * FROM questions WHERE id in (".$csvQs.") ");
    	
        return $query->result_array();
    }
    
    
    function get_questionsforRandomquiz($minQuestions)
    {
     $query =$this->db->query("SELECT id FROM questions order by RAND() limit ".$minQuestions);
    	
        return $query->result_array();
    }
    

    function insert_entry()
    {
    
		$data = array(
			'id' => '',
		   'quiz_id' => $_POST['quiz_id'] ,
		   'question' => $_POST['question'] ,
		   'created_date' => date("Y-m-d H:i:s")
		);

		$this->db->insert('questions', $data); 

        return $this->db->insert_id();
    }

    function update_entry($id)
    {
    
		$data = array(
		   'quiz_id' => $_POST['quiz_id'] ,
		   'question' => $_POST['question'] ,
		   'created_date' => date("Y-m-d H:i:s")
				);

		$this->db->where('id', $id);
		$this->db->update('questions', $data); 

        
    }
    
    function get_fun_quiz() {
    
    $this->db->select ( 'q.*,opt.*, opt.id' )
        ->from ( 'questions as q' )
        ->join ( 'question_options opt', 'q.id = opt.question_id');
    $query = $this->db->get ();
    
    return $query->result_array();
}

	
	
	function getNumberOfQuestionsInAllQuizzes() {
	
		$query = $this->db->query("SELECT count(*) as qcount ,quiz_id FROM questions group by quiz_id");

 
		return $query->result_array();
		
	}
	
	
	function get_question($questionID) {

		$this->db->where('id', $questionID);
		$query = $this->db->get('questions', $data);
		
		return $query->result_array(); 
		
	}
    
    
    
    function deletebyquiz($id){
    
    	$this->db->where('quiz_id', $id);
		$this->db->delete('questions'); 
    
    }
    
    function delete($id){
    
    	$this->db->where('id', $id);
		$this->db->delete('questions'); 
    
    }

}
