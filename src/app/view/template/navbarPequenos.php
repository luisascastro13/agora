<!-- ######## ######## ######## -->
<!-- dispositivos pequenos -->
<!-- ######## ######## ######## -->

<!-- navbar em cima para pequenos -->
<nav class="navbarPequena navbar navbar-expand-lg navbar-light bg-primary mb-3 sticky-top">
  	<div class="container-fluid">
  		<a class="navbar-brand" href="#" style="max-width: 25%;">
  			<img src="img/Loguinho.svg" style="max-width: 100%;">
  		</a>

  		<div class="dropdown">	  
	  		<a class="btn shadow-none pr-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
	    		<img src="https://moodle.canoas.ifrs.edu.br/pluginfile.php/32244/user/icon/boost/f1?rev=1351144" class="img-thumbnail rounded-circle border border-warning w-50 float-right" alt="Foto de perfil">
	  		</a>

			<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
				<li><a class="dropdown-item text-end" href="#">Configurações</a></li>
				<li><a class="dropdown-item text-end" href="#" onclick="sair();">Sair</a></li>
			</ul>
		</div>		
  	</div>
</nav>

<!-- navbar bottom-fixed para pequenos -->
<div class="navbar fixed-bottom d-flex bg-info navbarPequena" role="group" aria-label="Ações do usuário" style="height: 10%;">

	<div class="input-group w-75 d-flex justify-content-between" id="menuBottomSM">
		
		<!-- painel -->
		<a class="nav-link active text-light" aria-current="page" href="painel.php">
	        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em"height="1.5em"fill="currentColor" class="bi bi-easel" viewBox="0 0 16 16">
			  <path d="M8 0a.5.5 0 0 1 .473.337L9.046 2H14a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1.85l1.323 3.837a.5.5 0 1 1-.946.326L11.092 11H8.5v3a.5.5 0 0 1-1 0v-3H4.908l-1.435 4.163a.5.5 0 1 1-.946-.326L3.85 11H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h4.954L7.527.337A.5.5 0 0 1 8 0zM2 3v7h12V3H2z"/>
			</svg>
		</a>

		<!-- nucleos -->
		<a class="nav-link active text-light" aria-current="page" href="#">
			<svg xmlns="http://www.w3.org/2000/svg" width="1.5em"height="1.5em"fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
			  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
			</svg>
		</a>

		<!-- galeria -->
		<a class="nav-link active text-light" aria-current="page" href="#">
			<svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16">
				<path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/>
			</svg>
		</a>

		<!-- buscar -->
		<a class="nav-link active text-light" aria-current="page" href="buscar.php">
			<svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
			  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
			</svg>
		</a>
	</div>	    


	<!-- floating action button -->
	<a class="btn btn-lg btn-warning btn-floating position-absolute bottom-0 end-0 mb-4 mr-4" style="width: 56px; height: 56px;">
		<i class="bi bi-plus position-absolute top-50 start-50 translate-middle pb-2" style="font-size: 3.5em;"></i>
	</a>
	
			<!-- Modal PESQUISAR-->
			<div class="modal fade" id="pesquisar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Pesquisar</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">

			      	<!-- pesquisar -->
			      	<form method="post" action='../controller/Nucleo.controller.php?a=inserirMembro'>

			      		<label>Nome:</label>
			      		<input type="text" name="nomeMembro">

			      		<!-- esse id que está sendo passado é o id do nucleo atual -->
			      		<input type="hidden" name="id" value="<?=$id ?>">
			      		<!-- esse nome é o nome do nucleo atual-->
			      		<input input type="hidden" name="nome" value="<?=$nome ?>">

				      </div>
				      <div class="modal-footer">	      
				        <input type='submit' class="btn btn-primary">
				    </form>
			      </div>
			    </div>
			  </div>
			</div>

</div>


<script>	
	function sair(){
		Swal.fire({
		  text: "Você tem certeza de que deseja sair?",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Sim, quero sair.',
		  cancelButtonText: 'Não, voltar.'
		}).then((result) => {
		  if (result.isConfirmed){
		  	window.location = 	"../index.php";	
		  }
		})		
	}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>