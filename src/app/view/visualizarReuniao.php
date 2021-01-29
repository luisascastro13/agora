<?php
require_once '../model/Reuniao.class.php';
require_once '../dao/Reuniao.dao.php';
require_once '../dao/Nucleo.dao.php';
require_once '../model/Nucleo.class.php';
require_once '../dao/Ata.dao.php';
require_once '../model/Ata.class.php';
require_once '../model/Conexao.class.php';

if(!ISSET($_SESSION)){
  session_start();
}

$conn =  new Conexao();
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


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

$somenteData = date_format($data, 'Y-m-d');
$somenteHorario = date_format($data, 'H:i');

?>


<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<script type="text/javascript" src="js/js_1.9/jquery-1.8.2.js"></script>  
<script type="text/javascript" src="js/js_1.9/jquery-ui-1.9.1.custom.min.js"></script>  

<head>
  <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

  <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

  <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/translations/pt-br.js"></script>
</head>

<style>
  .ck-editor__editable {
    max-height: 400px;
}
  
</style>

<body>

<a href="visualizarNucleo.php?id=<?=$idNucleo?>">VOLTAR</a>

<h1><?="Reunião: ".$reuniao->getNome();?></h1>
<h2><?="Data e horário: ".$dataFormatada?></h2>

<!-- mostra espaço de edição da ata para o usuario adm -->
<?php if($userAdm==true){ ?>

  <!-- BOTÃO EDITAR REUNIÃO (abre modal EDITAR Reuniao) -->
  <button type="button" class="btn btn-sm btn-outline-warning" onClick="abrirModalEditarReuniao()">Editar Reunião</button>


  <!-- Modal EDITAR REUNIÃO -->
  <div class="modal fade" id="editarReuniao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Reunião</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
       
          <form method="post" action="../controller/Reuniao.controller.php?a=editar">

            <!-- INFORMACOES DA REUNIAO -->
            <!-- NOME DA REUNIAO -->
            <div class="input-group mb-3">
          <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Nome da reunião: </span>
            </div>
          <input type="text" class="form-control" placeholder="Reunião mensal" aria-label="Username" aria-describedby="basic-addon1" name="nome" required value="<?php echo $reuniao->getNome();?>">
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text">Data e Horário</span>
          <input type="date" aria-label="Data" class="form-control" name="data" required value="<?php echo $somenteData ?>">
          <input type="time" aria-label="Horário" class="form-control" name="horario" required value="<?php echo $somenteHorario;?>">
        </div>

        <!-- Descricao -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Descrição</span>
            </div>
            <textarea class="form-control" name="descricao"><?php echo $reuniao->getDescricao(); ?></textarea>
        </div>

        <h5 id="exampleModalLabel">Documentos</h5>
        <!-- DOCUMENTOS QUE GOSTARIA DE CRIAR  -->
            <div class="form-check">
          <input class="form-check-input"  name="ata" type="checkbox" value="" id="ata" <?php if(isset($ata)) {echo "checked";} if($reuniao->getIdAta() != null){ echo "checked"; } ?>>
            
            <label class="form-check-label" for="ata">Ata</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="listaPresenca" type="checkbox" value="" id="listaPresenca"
            <?php if(isset($listaPresenca)) {echo "checked";} if($reuniao->getIdListapresenca() != null){ echo "checked"; } ?>>
            <label class="form-check-label" for="listaPresenca">Lista de Presença</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="votacao" type="checkbox" value="" id="votacao"
            <?php if(isset($votacao)) {echo "checked";} if($reuniao->getIdVotacao() != null){ echo "checked"; } ?>>
            <label class="form-check-label" for="votacao">Votação</label>
        </div>

        <!-- INPUTS INVISIVEIS PARA PASSAR ID DO NUCLEO -->
            <input type="hidden" name="nomeNucleo" value="<?=$objNucleo->getNome();?>">
            <input type="hidden" name="idNucleo" value="<?=$objNucleo->getId(); ?>">
            <input type="hidden" name="idReuniao" value="<?=$idReuniao?>">
      
          </div>
          <div class="modal-footer">     
            <input type='submit'  class="btn btn-primary" value="Editar Reunião">
        </form>

        </div>
      </div>
    </div>
  </div>



   <?php if($reuniao->getIdAta() != null OR $reuniao->getIdListapresenca() != null OR $reuniao->getIdVotacao() != null){ 
      echo "<h3>Documentos:</h3>"; ?>

      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Ata
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" mh-10>
            <div class="accordion-body">
              
              <?php if($reuniao->getIdAta() != null){?>
                  
                  <form action="../controller/Ata.controller.php?a=atualizarAta" method="post" id="formularioAta">
                    <input type="hidden" name="idAta" value="<?=$reuniao->getIdAta()?>">
                    <input type="hidden" name="idReuniao" value="<?=$reuniao->getCodigo()?>">
                    <input type="hidden" name="idNucleo" value="<?=$reuniao->getIdNucleo()?>">

                    <textarea name="content" id="editor" class="document-editor">
                      <?php

                      $descricao = AtaDAO::mostrarDescricao($reuniao->getIdAta());
                      echo $descricao[0]['descricao'];
                     
                      ?>



                    </textarea>

                    <p><input type="submit" value="Salvar Ata" class="btn btn-sm btn-outline-info" ></p>
                  </form>
              
              <?php } ?>        
            </div>
          </div>
        </div>

        <?php if($reuniao->getIdListaPresenca() != null){ ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Lista de Presença
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                // <?php if($reuniao->getIdListaPresenca() != null){ 
                  echo "<h4>Lista presenca:</h4>"; ?>
                  aqui vai ter a lista ok<br>                
                  <a href="#" class="btn btn-sm btn-outline-info">Lista Presenca</a>
                <!-- <?php } ?> -->
              </div>
            </div>
          </div>
        <?php } ?>


       <!--  <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Accordion Item #3
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              
            </div>
          </div>
        </div>
      </div> -->
      
  <?php } ?>
<?php } ?>


</body>

<script>

   function abrirModalEditarReuniao(){
    $("#editarReuniao").modal('show');
   }  

</script>

<script>
    ClassicEditor
    .create( document.querySelector( '#editor' ), {
        language: 'pt-br',
        defaultLanguage: 'pt-br',
    } )

    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
   

</script>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</html>


