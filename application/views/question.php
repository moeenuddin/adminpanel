<?php include "header.php";?>

<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Question
                    <small>Add</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?=$this->config->site_url('QuizComposer');?>">Home</a>
                    </li>
                    <li class="active">Add Question</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
		<div class="row">
            <div class="col-lg-12">
                <h3>Add Question</h3>
                <form name="submit" method="post" action="<?=empty($questionID)?$this->config->site_url('QuestionComposer/save'):$this->config->site_url('QuestionComposer/save/'.$questionID)?>" id="contactForm" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Question</label>
                            <input name="question" type="text" class="form-control" id="question" value="<?=@$question[0]['question'];?>" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Quiz</label>
                            <select name="quiz_id" class="form-control">
                            <option value="0" <?=@$question[0]['quiz_id']==0?'selected':'';?>> None </option>
                            <?php
                            foreach($allQuiz as $id => $quiz){ ?>
                            <option value="<?=$id?>"> <?=$quiz;?> </option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <? for($i=0; $i< $questionOptionsCount;$i++){ 
                    
                    	
                    ?>
                    <div class="control-group form-group">
                        <div class="controls">
                        <label>Option <?=$i+1?>:</label>
                            <label class="checkbox-inline"><input name="correct[<?=$i+1?>]" type="checkbox" <?=@$questionOptions[$i]['is_correct']!=0?'checked':''?> value="<?=$i+1?>"> Is Correct?</label>
                            <input name="option[<?=$i+1?>]" type="text" value="<?=@$questionOptions[$i]['option']?>" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
                        </div>
                    </div>
                    <? } ?>
                    
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary">Save Question</button>
                </form>
            </div>

        </div>
        <!-- /.row -->
        
        <hr>
        
        <div class="row">
            <div class="col-lg-12">
            <h3>List of Questions</h3>
                <table class="table table-bordered">
				<thead>
				  <tr>
					<th>#</th>
					<th>Question</th>
					<th>Quiz</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
				  <?php
				
				foreach($allQuestion as $id => $val){
				?>
				  <tr>
					<td><?=$id+1?></td>
					<td><?=$val['question'];?></td>
					<td><?=$allQuiz[$val['quiz_id']];?></td>
					<td><a href='<?=$this->config->site_url('QuestionComposer/updateQuestion/'.$val['id'])?>'>edit</a> | <a href='<?=$this->config->site_url('QuestionComposer/delete/'.$val['id'])?>'>delete</a></td>
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
        <?=$pagination?>
        
        <!-- /.row -->

        <hr>

<?php include "footer.php"?>