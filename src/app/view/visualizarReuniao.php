<?php
require_once '../model/Reuniao.class.php';
require_once '../dao/Reuniao.dao.php';
require_once '../dao/Nucleo.dao.php';
require_once '../model/Nucleo.class.php';

########## CRIA OBJETO REUNIAO ###########
$idReuniao = $_GET['id'];
$reuniao = ReuniaoDAO::buscarPorId($_GET['id']);

######### CRIA OBJETO NUCLEO ############
$idNucleo = $reuniao->getIdNucleo();
$nucleo = NucleoDAO::buscarPorId($idNucleo);
$objNucleo = new Nucleo($nucleo[0]['nome']);
$objNucleo->setId($nucleo[0]['id']);

######### VERIFICA SE USUARIO LOGADO É ADM DO NUCLEO ########
$membrosNucleo = NucleoDAO::listarMembros($objNucleo);
// var_dump($membrosNucleo);
$usuariosAdm = array();
$login = $_SESSION['username'];
$userAdm = false;

foreach($membrosNucleo as $membro){
	if($membro[4] == 1){
		// imprime os ids dos usuarios adms
		// echo "Valor ". $membro[4]." no usuario: ". $membro[1]."<br>";			
		// se o membro for adm, insere o usuario em um array de adms
		array_push($usuariosAdm, $membro);
		if($membro[1] == $login){
			$userAdm = true;
		}
	}						
}
########## FORMATA A DATAHORA ############
$data = date_create($reuniao->getDatahora());
$dataFormatada = date_format($data, 'd/m/Y à\s H:i');
?>

<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<a href="visualizarNucleo.php?id=<?=$idNucleo?>">VOLTAR</a>

<h1><?="Reunião: ".$reuniao->getNome();?></h1>
<h2><?="Data e horário: ".$dataFormatada?></h2>
<h3>
	<?php
	if($reuniao->getIdAta() != null){
		echo "Documentos:";
	}?>
</h3>


<div class="form-floating">
  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 50%; width: 70%;"></textarea>
  <label for="floatingTextarea2">Comments</label>
</div>
<?php 
if($userAdm==true){ ?>
	<a href="#" class="btn btn-sm btn-outline-warning">Editar Reunião</a>
<?php } ?>





<!-- <div class="accordion" id="accordionExample">
 <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Ata
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      	<div class="form-check form-switch">
		  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
		  <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
		</div>
		
        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Lista de Presença 
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      	<div class="form-check form-switch">
		  <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
		  <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
		</div>
        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Votação
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
</div> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</html>


