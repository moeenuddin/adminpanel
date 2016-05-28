<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Create Quiz with Multiple choices and export to json">
    <meta name="author" content="getmoeen@gmail.com">

    <title>Quiz Manager</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=$this->config->base_url('css/bootstrap.min.css');?>" rel="stylesheet">
    
     <!-- Login  CSS -->
    <link href="<?=$this->config->base_url('css/style.css');?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=$this->config->base_url('css/modern-business.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=$this->config->base_url('font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

  <body>

    <div class="container">
    
    
    <div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">Trivia Admin</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="<?=$this->config->site_url('Adminpanel/login');?>">
						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="Email" id="username"  placeholder="Enter your Username"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="passcode" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						

						<div class="form-group ">
							<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
						</div>
						<div class="login-register">
				           
				            
				         </div>
					</form>
				</div>
			</div>
		</div>
    
    

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
