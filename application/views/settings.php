<?php include "header.php";?>

<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Settings
                    <small>Add</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?=$this->config->site_url('QuizComposer');?>">Home</a>
                    </li>
                    <li class="active">Setting </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
		<div class="row">
            <div class="col-lg-12">
                <h3>Settings</h3>
                <form name="submit" method="post" action="<?=$this->config->site_url('QuizSettings/update')?>" id="contactForm" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Number of Random Questions</label>
                            <input name="numberOfQuestions" value="<?=$numberOfQuestions?>" type="text" class="form-control" id="numberOfQuestions" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Count down time</label>
                            <input name="countDownTime" value="<?=$countDownTime?>" type="text" class="form-control" id="countDownTime" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" name="submit" class="btn btn-primary">Save Settings</button>
                </form>
            </div>

        </div>
        <!-- /.row -->
        
       
        <!-- /.row -->

        

<?php include "footer.php"?>