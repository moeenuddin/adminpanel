<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionComposer extends CI_Controller {

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
	public function index($p=1)
	{
	
	error_reporting(1);
	
		$this->checkLogin();
	
		$this->load->model('Questionmodel');
		
		
		$limit = 10;
		
		$start = $p==1?0:($p-1)*$limit;
		
		$pages = 10;
		
		//echo $start ."_".$limit;
		
		error_reporting(1);
		
		$totalQuiz = $this->Questionmodel->get_question_count();
		
		$pages = $totalQuiz/$limit;
		
		$data['allQuestion'] = $this->Questionmodel->get_questions($limit, $start);
		
		$this->load->model('Quizmodel');
		
		$allQuiz= $this->Quizmodel->get_all_quizzes();
		
		$link = $this->config->site_url('QuestionComposer/index');
		
		$data['pagination'] = $this->pagination_html($pages,$p,$link);
		
		$data['questionOptionsCount'] = 5;
	
		
		$arrAllQuiz= array();
		
		foreach($allQuiz as $d => $val ){
			
			$arrAllQuiz[$val['id']] = $val['title'];
			
		}
		
		$data['allQuiz'] = $arrAllQuiz;
		
		
		
		$this->load->view('question',$data);
	}
	
	public function updateQuestion($questionID)
	{
		if(empty($questionID)) redirect('QuestionComposer/');
		
		$this->load->model('Questionmodel');
		$this->load->model('Questionoptionmodel');
		
		
		
		$p =1;
		
		$limit = 10;
		
		$start = $p==1?0:($p-1)*$limit;
		
		$pages = 10;
		
		//echo $start ."_".$limit;
		
		error_reporting(1);
		
		$totalQuiz = $this->Questionmodel->get_question_count();
		
		$pages = $totalQuiz/$limit;
		
		$data['allQuestion'] = $this->Questionmodel->get_questions($limit, $start);
		
		$this->load->model('Quizmodel');
		
		$allQuiz= $this->Quizmodel->get_all_quizzes();
		
		$link = $this->config->site_url('QuestionComposer/index');
		
		$data['pagination'] = $this->pagination_html($pages,$p,$link);
		
		
		$arrAllQuiz= array();
		
		foreach($allQuiz as $d => $val ){
			
			$arrAllQuiz[$val['id']] = $val['title'];
			
		}
		
		$data['allQuiz'] = $arrAllQuiz;
		
		$data['questionOptionsCount'] = 5;
		$data['questionID'] = $questionID;
		
		$data["question"] = $this->Questionmodel->get_question($questionID);
		$data["questionOptions"] = $this->Questionoptionmodel->get_options($questionID);
		
		$this->load->view('question',$data);
	}
	
	
	public function pagination_html($pages,$current,$link){
		
		
		
		
		$Startstr = "
		
		<div class='row text-center'>
            <div class='col-lg-12'>
                <ul class='pagination'>
                <li>
                        <a href='#'>&laquo;</a>
                    </li>
        ";
        
        $item = "";
        
        for($i = 0; $i<$pages; $i++){
        
        	$item.= " <li ".($current==($i+1)?"class='active'":"").">
                        <a href='".$link."/".($i+1)."'>".($i+1)."</a>
                    </li> ";
        
        }
               
        $Endstr = "      
                    <li>
                        <a href='#'>&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>";
        
        
        $pagin = $Startstr.$item.$Endstr;
		
		return $pagin;
		
	}
	
	public function save($questionID=''){
	
		$this->checkLogin();

		if(count($_POST) > 0){
		
			$this->load->model('Questionmodel');
			$this->load->model('Questionoptionmodel');
			
			$bFlag = false;
			
			foreach($_POST['option'] as $v){
				if(empty($v))
					$bFlag = true;
				
			}
		
			//print_r($_POST);
			if(count($_POST) > 0 && $questionID == ''){
		
				$question_id = $this->Questionmodel->insert_entry();
				
				$this->Questionoptionmodel->insert_entry($question_id );
		
			}else if(count($_POST) && $questionID >0){
		
				$this->Questionmodel->update_entry($questionID);
				
				$this->Questionoptionmodel->update_entry($questionID );
				
			}
		
		redirect('QuestionComposer/');
		
		}
	
	}
	
	private function checkLogin(){
	
		if(	$_SESSION["trivia_user"] != "Administrator") redirect('Adminpanel/');
	
	}
	
	public function delete($id){
	
		$this->checkLogin();
		
		if(empty($id)) die('Invalid value');
		
		$this->load->model('Questionoptionmodel');
		$this->Questionoptionmodel->delete($id);
		
		$this->load->model('Questionmodel');
		$this->Questionmodel->delete($id);
		redirect('QuestionComposer/index');
	}
	
	
}
