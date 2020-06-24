<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <link href='https://fonts.google.com/specimen/Advent+Pro' rel='stylesheet' type='text/css'>

	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<title>TestePHP</title>
	</head>
	<body style="height: 100vh;" class="overflow-hidden">
			<div class="row bg-light align-items-center" style="height: 20vh">
				<div class="col-6">
					<a href="inicio.php">
							<img class="ml-4" src="LogoTextoCaneta.svg">						
					</a>				
				</div>
				<div class="col-6">
					<ul class="nav justify-content-end">
						<li class="nav-item">
								<a class="nav-link active" href="#">Saiba mais</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Acompanhar</a>
						</li>
					</ul>					
				</div>
			</div>

			<div class="row bg-secondary" style="height: 80vh; background-image: url('bglogin.png');"">
				 <!--  height: 100%; background-size: cover;"> -->
				<div class="col-3"></div>
				<div class="col-6">
					<div class="nav justify-content-center my-4">
						<p class="h3 text-white">Acesse o Ágora fazendo seu login!</p>		
					</div>			
					<div class="px-5 py-3 rounded bg-light mx-auto" style="width: 30vw">
						<form method="POST" action="form.php">
							<div class="w-50 mx-auto">
								<div class="form-group">
									<label for="login">Usuário:</label>				
									<input type="text"  class="form-control" id="login" name="login">
								</div>
								<div class="form-group">
									<label for="senha">Senha:</label>
									<input type="password" class="form-control" id="senha" name="senha">
								</div>
								<div class="form-group">
									<button type="submit" name="enviar" class="btn-block btn btn-primary text-nowrap">Acessar<img width="20" src="moodleicon.png"></button>
								</div>
							</div>
						</form>
						<label class="nav justify-content-center">
							<?php
								if(isset($_REQUEST['msg'])){
									if($_REQUEST['msg']=='1'){
										echo 'Usuário e/ou senha inválido(s)';
									}
								}		
							?>						
						</label>
					</div>																			
			<div class="col-3"></div>
			</div>
	
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	</body>
</html>