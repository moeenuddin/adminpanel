<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuizComposer extends CI_Controller {

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
		
		
		//
		$this->checkLogin();
		
		//echo "hello";exit;
		
		$this->load->model('Quizmodel');
		
		
		
		
		
		$limit = 10;
		
		$start = $p==1?0:($p-1)*$limit;
		
		$pages = 10;
		
		//echo $start ."_".$limit;
		
		error_reporting(1);
		
		$totalQuiz = $this->Quizmodel->get_quizzes_count();
		
		$pages = $totalQuiz/$limit;
		
		$data['allQuiz'] = $this->Quizmodel->get_quizzes($limit, $start);
		
		$data['recordNo'] = $start;
		
		$link = $this->config->site_url('QuizComposer/index');
		
		$data['pagination'] = $this->pagination_html($pages,$p,$link);
		
		
		$this->load->view('quiz', $data);
		
	}
	
	
	public function updateQuiz($quizID)
	{
		
		
		$p=1;
		
		//
		$this->checkLogin();
		
		//echo "hello";exit;
		
		$this->load->model('Quizmodel');
		
		
		
		
		
		$limit = 10;
		
		$start = $p==1?0:($p-1)*$limit;
		
		$pages = 10;
		
		//echo $start ."_".$limit;
		
		error_reporting(1);
		
		$totalQuiz = $this->Quizmodel->get_quizzes_count();
		
		$pages = $totalQuiz/$limit;
		
		$data['allQuiz'] = $this->Quizmodel->get_quizzes($limit, $start);
		
		$data['quiz'] = $this->Quizmodel->get_quiz($quizID);

		$data['quizID'] = $quizID;
		
		
		$data['recordNo'] = $start;
		
		$link = $this->config->site_url('QuizComposer/index');
		
		$data['pagination'] = $this->pagination_html($pages,$p,$link);
		
		
		$this->load->view('quiz', $data);
		
	}
	
	private function checkLogin(){
	
		if(	$_SESSION["trivia_user"] != "Administrator") redirect('Adminpanel/');
	
	}
	
	public function save($quizID =''){
	
		$this->checkLogin();
	
		$this->load->model('Quizmodel');
		
		//print_r($_POST); exit;
		if(count($_POST) > 0 && $quizID ==''){
		
			
			$this->Quizmodel->insert_entry();
			
		
		}else if(count($_POST) > 0){
		
			$this->Quizmodel->update_entry($quizID);
		
		}
		
		redirect('QuizComposer/');
	
	}
	
	public function update(){
	
		$this->load->model('QuizComposer_Model');
		if(count($_POST) > 1 && $_POST["submit"]){
		
			
			$this->QuizComposer_Model->insert_entry();
			
		
		}
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
	
	public function delete($id){
		
		$this->checkLogin();
	
		if(empty($id)) die('Invalid value');
		
		$this->load->model('Quizmodel');
		$this->load->model('Questionmodel');
		
		$this->Questionmodel->deletebyquiz($id);
		
		$this->load->model('Quizmodel');
		
		$this->Quizmodel->delete($id);
		redirect('QuizComposer/');
		//header('location: QuizComposer');
	}
}
