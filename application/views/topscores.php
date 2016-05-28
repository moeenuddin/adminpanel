<?php include "header.php";?>

<!-- Page Heading/Breadcrumbs -->
        
        
        <div class="row">
            <div class="col-lg-12">
            <h3>Top users</h3>
                <table class="table table-bordered">
				<thead>
				  <tr>
					<th>#</th>
					<th>Name</th>
					<th>Score</th>
					
				  </tr>
				</thead>
				<tbody>
				
				<?php
				
				foreach($allScores as $id => $val){
				?>
				  <tr>
					<td><?= ++$recordNo?></td>
					<td><?=$val['user_name'];?></td>
					<td><?=$val['score'];?></td>
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