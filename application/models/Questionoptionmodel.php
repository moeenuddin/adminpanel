<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questionoptionmodel extends CI_Model {

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
    
    function get_options($qid)
    {
    
	    $this->db->where('question_id='.$qid);
        $query = $this->db->get('question_options');
        return $query->result_array();
    }

    function insert_entry($qid)
    {
    
  		foreach($_POST['option'] as $i => $v){
  		// echo $_POST['correct'][$i]." >> ".$i;
  		
  			if(empty($v)) continue;
  			
  			$correct  = @$_POST['correct'][$i]>0?$_POST['correct'][$i]:0;
  			
  			//echo $correct." -";
			$data = array(
				'id' => '',
			   'option' => $v ,
			   'question_id' => $qid ,
			   'is_correct' => $correct
			);

			$this->db->insert('question_options', $data); 

  		}
    
		
        
    }

    function update_entry($questionID)
    {
    
    $this->delete($questionID);
    $this->insert_entry($questionID);
    /*
    
		$data = array(
		   'quiz_id' => $_POST['quiz_id'] ,
		   'question' => $_POST['question'] ,
		   'created_date' => Date("YYYY-mm-dd hh:dd:ss",time())
				);

		$this->db->where('id', $id);
		$this->db->update('question_options', $data); 
*/
        
    }
    
    
    function delete($id){
    
    	$this->db->where('question_id', $id);
		$this->db->delete('question_options'); 
    
    }

}
