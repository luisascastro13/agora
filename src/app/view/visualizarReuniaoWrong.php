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
else {
  // $_SESSION['conn'] = $conn;
  $usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);

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

<!DOCTYPE html>
<html>
<?php include('template/head.php'); ?>
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
<!-- container grandao da pagina -->
<div class="container-fluid m-0 p-0">

  <!-- TELA TODA -->
    <div class="row p-0 m-0">

    <?php include('template/navbarPequenos.php'); ?>
    <?php include('template/navbarGrandes.php'); ?> 

        <!-- CONTEÚDO DA PÁGINA -->
      <div id="pagina" class="container-fluid pl-md-4">

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
            <div class="modal-footer d-flex justify-content-between">
              <a class="link-danger" href="#" onclick="excluirReuniao()">Excluir reunião</a>     
              <input type='submit'  class="btn btn-primary" value="Salvar Alterações">
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
                  <?php
                  if($reuniao->getIdListaPresenca() != null){ 
                    echo "<h4>Lista presenca:</h4>"; ?>
                    aqui vai ter a lista ok<br>                
                    <a href="#" class="btn btn-sm btn-outline-info">Lista Presenca</a>
                  <?php 
                  } 
                  ?>
                </div>
              </div>
            </div>
          <?php } ?>
    <?php } ?>
  <?php } ?>

    <!-- fecha o conteudo da pagina -->
    </div>

  <!-- fecha a row da tela toda -->
    </div>
<!-- fecha o container grandao da pagina     -->
</div>


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
        window.location =   "../index.php"; 
      }
    })    
  }

  function abrirModalEditarReuniao(){
    $("#editarReuniao").modal('show');
  } 

  function excluirReuniao(){
    if(confirm('Are you sure?')){
      console.log('sim, quero sair;');
      $("#editarReuniao").modal('hide');
    }
  }

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

</body>
</html>
<?php } ?>