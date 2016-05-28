<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RandomQuiz extends CI_Controller {

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
		$this->load->model('Quizmodel');
		$this->load->model('Questionmodel');
		$this->load->model('Questionoptionmodel');
		
		$this->load->model('QuizSettingsmodel');
		
		//select quizes
		
		$arrSettings = $this->QuizSettingsmodel->get_all_settings();
		
		$data[$arrSettings[0]['name']] = $arrSettings[0]['value'];
		$data[$arrSettings[1]['name']] = $arrSettings[1]['value'];
		
		$countDownTime = $arrSettings[1]['value'];
		
		$minQuestions = $arrSettings[0]['value'];
		
		
		
		//select quizes
		
		$data['allQuiz'] = $this->Quizmodel->get_all_quizzes();
		$dataTrm = $this->Questionmodel->getNumberOfQuestionsInAllQuizzes();
		
		$allQ = array();
		
		$dataTrm = $this->Questionmodel->get_questionsforRandomquiz($minQuestions);
		
		foreach($dataTrm as $id => $val){
		
			$allQ[]=$val['id'];
		
		}
		
		$selectedQ = array();
		
		if(count($allQ) < $minQuestions ){
		
		echo count($allQ)." - ".$minQuestions;
		exit(0);
		
		
			redirect('QuestionComposer/');
		}else{
		
		$selectedQ =$allQ;
		}
		
		//print_r($allQ);
		
		
		/*
		while(count($selectedQ) !== $minQuestions)
		{
			$selectedNumber = rand(0,count($allQ)-1);
			
			if(!in_array($allQ[$selectedNumber],$selectedQ))
				$selectedQ[] = $allQ[$selectedNumber];
			
		}*/
		
		$qIDs = implode(",",$selectedQ);
		
		
		$allData = $this->Questionmodel->get_questionsWithIDs($qIDs);
			
			
			
			$question = array();
			
			$allquiz = array();
			
			$quiz = array();
			$done = array();
			$qid = 0;
			foreach($allData as $id => $val){
			
			
				if(!in_array($val["quiz_id"],$done)){
					
					$done[]=$val["quiz_id"];
					$qid = 0;
				}
				
				$question['id'] = $qid;
				$question['qzid'] =  $val["quiz_id"];
				$question['text'] = $val["question"];
				$question['correct'] = false;
				$question['countDownTime'] = $countDownTime;
				
				$arr = $this->Questionoptionmodel->get_options($val["id"]);
				
				//print_r($arr); exit;
				$question['image'] = '';
				
				foreach($arr as $index => $val2){
				
					$question['options'][$index]['id'] = $index;
					$question['options'][$index]['text'] = $val2['option'];
					$question['options'][$index]['answer'] = $val2['is_correct']?1:0;
				
				}
				
				
				$quiz[$val["quiz_id"]]['qzid']=$val["quiz_id"];
				$quiz[$val["quiz_id"]]['title']="Fun Quiz";
				$quiz[$val["quiz_id"]]['allQuestions'][]=$question;
			
				$qid++;
			}
			
			foreach($quiz as $d =>$singleQuiz){
			
				$allquiz[] = $singleQuiz;
				
			}
			
			
			if(empty($allquiz)){
			
				$data['json'] = "No data Avialable!";
				
			}else{
				
				$data['json'] = json_encode($allquiz);
				
			}
			
			
			
			$this->load->view('json_view',$data);
	
		
		//$data['questCount']
		//$data['questCount'] = $this->Questionmodel->getNumberOfQuestionsInAllQuizzes();
		
		//print_r($data);exit;
	//	$this->load->view('generate', $data);
	}
	
	public function topscores(){
	
	
		$this->load->view('topscores', $data);
		
	}
	
	public function generate(){
	
	
	
		$this->load->model('Quizmodel');
		$this->load->model('Questionmodel');
		$this->load->model('Questionoptionmodel');
		
		//print_r($_POST); exit;
		if(count($_POST) > 0 ){
		
		
			$strQuizID = implode(",",$_POST["quiz"]);
			echo $strQuizID;
			
			$allData = $this->Questionmodel->get_questionsforquiz($strQuizID);
			
			//print_r($allData); exit;
			
			$question = array();
			
			$allquiz = array();
			
			$quiz = array();
			$done = array();
			$qid = 0;
			foreach($allData as $id => $val){
			
			
				if(!in_array($val["quiz_id"],$done)){
					
					$done[]=$val["quiz_id"];
					$qid = 0;
				}
				
				$question['id'] = $qid;
				$question['qzid'] =  $val["quiz_id"];
				$question['text'] = $val["question"];
				$question['correct'] = false;
				
				$arr = $this->Questionoptionmodel->get_options($val["id"]);
				
				//print_r($arr); exit;
				$question['image'] = '';
				
				foreach($arr as $index => $val2){
				
					$question['options'][$index]['id'] = $index;
					$question['options'][$index]['text'] = $val2['option'];
					$question['options'][$index]['answer'] = $val2['is_correct']?1:0;
				
				}
				
				
				$quiz[$val["quiz_id"]]['qzid']=$val["quiz_id"];
				$quiz[$val["quiz_id"]]['title']="Fun Quiz";
				$quiz[$val["quiz_id"]]['allQuestions'][]=$question;
			
				$qid++;
			}
			
			foreach($quiz as $d =>$singleQuiz){
			
				$allquiz[] = $singleQuiz;
				
			}
			
			
			if(empty($allquiz)){
			
				$data['json'] = "No data Avialable!";
				
			}else{
				
				$data['json'] = json_encode($allquiz);
				
			}
			
			
			
			$this->load->view('json_view',$data);
		
		//exit;
		
		}else{
		
		header('location: index');
		}
		
		
	
	}
	
	
}
