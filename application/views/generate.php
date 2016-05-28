<?php include "header.php";?>

<!-- Page Heading/Breadcrumbs -->
  
   <form name="submit" method="post" action="<?=$this->config->site_url('GenerateData/generate')?>" id="contactForm" novalidate>
        <div class="row">
            <div class="col-lg-12">
            <h3>Select Quizzes for Mobile App</h3>
                <table class="table table-bordered">
				<thead>
				  <tr>
					<th>#</th>
					<th>Title</th>
					<th>Description</th>
					<th>Question Count</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
				
				<?php
				
				foreach($allQuiz as $id => $val)
				{
				?>
				  <tr>
					<td><?=$id+1?><input name=quiz[<?=$val['id']?>] type="checkbox" value="<?=$val['id']?>"/></td>
					<td><?=$val['title'];?></td>
					<td><?=$val['description'];?></td>
					<td><?=in_array($val['id'],array_keys($questCount))?$questCount[$val['id']]:0;?></td>
					<td><!--<a href='<?=$this->config->site_url('QuizComposer/edit/'.$val['id'])?>'>edit</a> | <a href='<?=$this->config->site_url('QuizComposer/delete/'.$val['id'])?>'>delete</a>--></td>
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
        <div class="row text-center">
        	<div class="col-lg-3"> <button type="submit" class="btn btn-primary">Generate Question</button> </div>
        	</form>
            <!--<div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>-->
        </div>
        <!-- /.row -->

        <hr>

<?php include "footer.php"?>