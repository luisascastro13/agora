<?php

function mostrarReuniao(){

	$bd = new PDO('mysql:host=localhost;dbname=agora', 'useragora', '');

			if (!$bd) {
			    echo "Error: Unable to connect to MySQL." . PHP_EOL;
			    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			    exit;
			}
			else {

				try{

					$codigoreuniao = $_SESSION['codigoreuniao'];

					$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$bd->beginTransaction();
						$comando = $bd->prepare('SELECT * FROM reuniao where codigo = ?');
						$comando->execute(array($codigoreuniao));
					$bd->commit();

					if($comando){
						
						while($linha = $comando->fetch(PDO::FETCH_ASSOC)){

						echo "
						<form action='alterarInformacoesReuniao.php'>
						  <label for='nomereuniao'>Nome da Reunião:</label>
						  <input type='text' name='nomereuniao' value='{$linha['nome']}'><br><br>
						  <label for='data'>Data da Reunião:</label>
						  <input type='datetime' name='datareuniao' value='{$linha['data']}'><br><br>
						<label for='local'>Local:</label>
						  <input type='text' name='local' value=''>

						  <h2>Documentos</h2>
						  

					<div class='accordion accordion-flush' id='accordionFlushExample'>		 


						  <div class='accordion-item'>
						    <h2 class='accordion-header' id='flush-headingTwo'>
						      <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseTwo' aria-expanded='false' aria-controls='flush-collapseTwo'>
						        CRIAR ATA
						      </button>
						    </h2>
						    <div id='flush-collapseTwo' class='accordion-collapse collapse' aria-labelledby='flush-headingTwo' data-bs-parent='#accordionFlushExample'>
						      <div class='accordion-body'>

						      <a class='btn btn-primary' href='#'>ATUALIZA</a>

						      </div>
						    </div>
						  </div>

						   <div class='accordion-item'>
						    <h2 class='accordion-header' id='flush-headingOne'>
						      <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseOne' aria-expanded='false' aria-controls='flush-collapseOne'>
						        CRIAR VOTAÇÃO
						      </button>
						    </h2>
						    <div id='flush-collapseOne' class='accordion-collapse collapse' aria-labelledby='flush-headingOne' data-bs-parent='#accordionFlushExample'>
						      <div class='accordion-body'>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
						    </div>
						  </div>




						  <div class='accordion-item'>						  
						    <h2 class='accordion-header' id='flush-headingThree'>
						      <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseThree' aria-expanded='false' aria-controls='flush-collapseThree'>
						        CRIAR LISTA DE PRESENÇA
						      </button>
						    </h2>
						    <div id='flush-collapseThree' class='accordion-collapse collapse' aria-labelledby='flush-headingThree' data-bs-parent='#accordionFlushExample'>
						      <div class='accordion-body'>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
						    </div>
						  </div>
						</div>


						<input type='submit' value='Alterar Informações'>
						</form>";						
						}
					}
					else{
					echo "Ops.";
					}
				}
				
				catch(Exception $e){
					echo $e->getMessage();
					print_r($e->getTrace());
					$bd->rollback();
				}		
			}



}


?>