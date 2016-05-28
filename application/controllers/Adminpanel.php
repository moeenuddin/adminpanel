<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpanel extends CI_Controller {

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
		
		$this->load->model('Adminpanelmodel');
		
		/*
		$limit = 10;
		
		$start = $p==1?0:($p-1)*$limit;
		
		$pages = 10;
		
		//echo $start ."_".$limit;
		
		error_reporting(1);
		
		$totalQuiz = $this->GameScoremodel->get_scores_count();
		
		$pages = $totalQuiz/$limit;
		
		$data['allScores'] = $this->GameScoremodel->get_scores($limit, $start);
		
		$data['recordNo'] = $start;
		
		$link = $this->config->site_url('GameScore/index');
		
		$data['pagination'] = $this->pagination_html($pages,$p,$link);
		*/
		
		$data =array();
		
		$this->load->view('login', $data);
		
	
		
	}
	
	public function login(){
	
	

		if(count($_POST)){
		
			if($_POST["Email"] == "trivia@gmail.com" && $_POST["passcode"] == "12!")
			{
			
				$_SESSION["trivia_user"] = "Administrator";
				
				redirect('QuizComposer/');
			
			}else{
			
				redirect('Adminpanel/');
				exit;
			}
		
		}
 
 
 	
		//$this->load->view('topscores', $data);
		
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
	
	public function logout(){
	
		$_SESSION["trivia_user"] = "";
		
		redirect('Adminpanel/');
		exit(0);
		
	
	}
	
	
}
