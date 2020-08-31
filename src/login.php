<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<title>Ágora</title>
	</head>
	<body>
		<div style="overflow: hidden;">

			<nav class="navbar navbar-expand-md navbar navbar-light bg-light sticky-top" id="nav">

                <a class="navbar-brand" href="index.php">

                    <img src="LogoTextoCaneta.svg" alt="" loading="lazy" id="logo">

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link">Saiba Mais</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Acompanhe</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Login</a>
                        </li>
                    </ul>
                </div>
        </nav>


			<div class="container-fluid h-75" style="background-color: #44A7B1;">

					<div class="row">
						<div class="col">

							<div class="nav justify-content-center my-4">
								<p class="h3 text-white">Acesse o Ágora fazendo seu login!</p>		
							</div>	

							<div class="px-5 py-3 rounded bg-light mx-auto col-lg-4 col-md-6 col-sm-8">

								<form method="POST" action="form.php">
									<div class="w-75 mx-auto">
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

							
							<p class="text-white text-center py-5 mb-4">Não tem uma conta? <a href="#" class="alert-link text-warning">Cadastre-se!</a></p>	
							
									
					</div>

				</div>

			</div>
		</div>


		<footer class="footer py-4" style="background-color: #0D4968;">
            <div class="container w-75 align-center text-center">
                <span class="text-muted">© Copyright 2020 Ágora. All Rights Reserved.</span>
            </div>
        </footer>
		
	
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	</body>
</html>