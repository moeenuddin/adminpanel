<?php include "header.php";?>

<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quiz
                    <small>Add</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?=$this->config->site_url('QuizComposer');?>">Home</a>
                    </li>
                    <li class="active">Add Quiz</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
		<div class="row">
            <div class="col-lg-12">
                <h3>Add Quiz</h3>
                <form name="sentMessage" id="contactForm" method="post" action="<?=empty($quizID)?$this->config->site_url('QuizComposer/save'):$this->config->site_url('QuizComposer/save/'.$quizID);?>" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Title</label>
                            <input type="text" name="title" value="<?=@$quiz[0]['title']?>" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Short Description:</label>
                            <textarea name="description" rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none">
                            <?=@$quiz[0]['description']?></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button name="submit" type="submit" class="btn btn-primary">Save Quiz</button>
                </form>
            </div>

        </div>
        <!-- /.row -->
        
        <hr>
        
        <div class="row">
            <div class="col-lg-12">
            <h3>List of Quizzes</h3>
                <table class="table table-bordered">
				<thead>
				  <tr>
					<th>#</th>
					<th>Title</th>
					<th>Description</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
				
				<?php
				
				foreach($allQuiz as $id => $val){
				?>
				  <tr>
					<td><?= ++$recordNo?></td>
					<td><?=$val['title'];?></td>
					<td><?=$val['description'];?></td>
					<td><a href='<?=$this->config->site_url('QuizComposer/updateQuiz/'.$val['id'])?>'>edit</a> | <a href='<?=$this->config->site_url('QuizComposer/delete/'.$val['id'])?>'>delete</a></td>
				  </tr>
				<?php
				}
				?>
				 
				</tbody>
			  </table>
            </div>

        </div>
        <!-- /.row -->

        <!-- Pagination -->
        
        <?php echo $pagination?>
        
        <!-- /.row -->

        <hr>

<?php include "footer.php"?>