<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GameScore extends CI_Controller {

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
		
		$this->checkLogin();
		
		$this->load->model('GameScoremodel');
		
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
		
		
		$this->load->view('topscores', $data);
		
	
		
	}
	
	private function checkLogin(){
	
		if(	$_SESSION["trivia_user"] != "Administrator") redirect('Adminpanel/');
	
	}
	
	public function topscores(){
	
	
	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
 
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
    $postdata = file_get_contents("php://input");
    

 if (isset($postdata)) {
 
 $request = json_decode($postdata);
 
 $this->load->model('GameScoremodel');
 
 $username = $request->name;
 
 $score = $request->score;

 $ip = $_SERVER['REMOTE_ADDR'];
 
    $data["ip"] = $ip;
	$data["name"] = $username;
	$data["score"] = $score; 
 
 $this->GameScoremodel->insert_entry($data);
 
 
 if ($username != "") {
 echo "Server returns: " . $username;
 }
 else {
 echo "Empty username parameter!";
 }
 }
 else {
 echo "Not called properly with username parameter!";
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
	
	
	
	
}
