<?php
require_once ('../jpgraph/src/jpgraph.php');
require_once ('../jpgraph/src/jpgraph_pie.php');

require_once '../model/Reuniao.class.php';
require_once '../dao/Reuniao.dao.php';
require_once '../dao/Nucleo.dao.php';
require_once '../model/Nucleo.class.php';
require_once '../dao/Ata.dao.php';
require_once '../model/Ata.class.php';
require_once '../model/Conexao.class.php';
require_once '../dao/ListaPresenca.dao.php';
require_once '../dao/Alternativa.dao.php';
require_once '../dao/Pergunta.dao.php';


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

  if(isset($_GET['msg'])){
    switch($_GET['msg']){
      case '1':
      echo "<script>alert('Já existe núcleo com esse nome. Tente outro.')</script>";
    }
  }

########## CRIA OBJETO REUNIAO ###########
$idReuniao = $_GET['id'];
$reuniao = ReuniaoDAO::buscarPorId($_GET['id']);

$idVotacao = $reuniao->getIdVotacao();

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

$somenteData = date_format($data, 'd-m-Y');
$somenteHorario = date_format($data, 'H:i');

// echo $somenteData;   

?>

<!doctype html>
<html lang="en">
  <head>      
    <meta charset="utf-8">

    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/translations/pt-br.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.css" rel="stylesheet"/>

    <title>Document</title>  

    <style type="text/css">

      @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");

      /* até 768px ele esconde essas coisas */
      @media screen and (max-width: 768px) {
         .navbarGrande{
              display:none;
         }
      }

      /* a partir de 769px ele mostra essas */
      @media screen and (min-width: 769px) {
         .navbarPequena{
              display:none !important;
         }

         #pagina{
          width: calc(100% - 180px);
         }
      }

      .navbarGrande li{
        margin-left: 1em;
        padding-left: 0;
      }

    </style>
  </head>
  <body>

    <!-- container grandao da pagina -->
    <div class="container-fluid m-0 p-0">

      <!-- TELA TODA -->
        <div class="row p-0 m-0">

        <?php
          include('template/navbarPequenos.php');
          include('template/navbarGrandes.php');
        ?>

          <!-- CONTEÚDO DA PÁGINA -->
          <div id="pagina" class="container-fluid pl-md-4 mt-2">       

            <div class="row">

              <div>                
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">                  
                    <li class="breadcrumb-item"><a href="painel.php">Painel</a></li>
                    <li class="breadcrumb-item"><a href="visualizarNucleo.php?id=<?=$idNucleo?>">Núcleo</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reunião</li>
                  </ol>
                </nav>
              </div>


              <div class="d-flex justify-content-between">
                <h1><?=$reuniao->getNome()?></h1>
                
                <!-- BOTÃO DETALHES -->
                <a href="detalhesReuniao.php?id=<?=$idReuniao?>" class="btn btn-primary btn-sm h-75 d-flex align-items-center">Detalhes</a>
              </div>             
            </div>
            <h2>Data: <?=$dataFormatada?></h2>

            <!-- SE EXISTE ALGUM DOCUMENTO RELACIONADO À REUNIAO, MOSTRAR ESSES ACCORDIONS DE ACORDO COM OS DOCUMENTOS EXISTENTES -->
            <div class="accordion mb-5 pb-4" id="accordionExample">

                <!-- ATA -->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Ata
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">

                    <?php if($userAdm == true)
                    { ?>
                    <div class="accordion-body">

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

                    </div>

                   <?php } else { ?>
                    <div class="accordion-body">
                      <?php
                          $descricao = AtaDAO::mostrarDescricao($reuniao->getIdAta());
                          
                          if($descricao[0]['descricao'] == null){
                            echo "Opa. A ata ainda não foi escrita.";
                          }
                          else{
                            echo $descricao[0]['descricao']; 
                          }                    
                        ?>
                    </div>
                   <?php } ?>

                  </div>
                </div>

                <!-- VOTACAO -->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Votação
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                      <a class="link-success d-inline" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Ver resultados</a>
 
                    
                      <?php if($userAdm == true)
                      { ?>                    
                          <div class="row">
                            <div class="d-flex justify-content-start">
                              <a href="editarVotacao.php?id=<?=$idReuniao?>" class="btn btn-outline-warning">Editar votação</a>
                            </div>
                          </div>
                      <?php } ?>

                      <div class="row">
                        <?php foreach(PerguntaDAO::mostrarPerguntasVotacao($reuniao->getIdVotacao()) as $perg){ 

                          $res = PerguntaDAO::verificarSeUsuarioJaVotouNaPergunta($_SESSION['username'], $perg['id']);  
                          $count = count($res);
                          
                          if($count != 0){ ?>
                            <div class="col-sm-6 col-lg-4 my-2">
                              <div class="card border border-success">
                                  <div class="card-body pb-1">
                                    <h5 class="card-title d-flex justify-content-between">
                                      <span><?=$perg['enunciado']?></span>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                      </svg>
                                    </h5>
                                    <a href="#" class="link-success"></a>


                                    <div class="collapse" id="collapseExample">
                                      <div class="">
                                        <!-- qual caminho da imagem?s -->

                                        <?php

                                        // $caminho = "votos/".$idVotacao."/".$perg['id'].".jpg";

                                        // echo '<img class="card-img-top" src="'.$caminho.'" style="width: 18rem;">';
                                         
                                        ?>

                                        <img src="criarGrafico.php?idPerg=<?=$perg['id']?>">


                                      </div>
                                    </div>


                                  </div>                                              
                              </div>
                            </div>
                         <?php }
                          else{ ?>                          

                              <div class="col-sm-6 col-lg-4 my-2">
                                  <form action="../controller/Votacao.controller.php?a=votar" method="POST" id="myForm">
                                  <div class="card">


                                    <div class="card-body pb-1">
                                      <h5 class="card-title">
                                        <span><?=$perg['enunciado']?></span>
                                      </h5>
                                    </div> 
                                    <div class="px-3">  
                                        <?php if($perg['tipo_pergunta'] == 2){
                                          echo "<div class='fw-bold'>Alternativas: </div>";
                                          foreach(AlternativaDAO::buscarAlternativasDePergunta($perg['id']) as $alt){ ?>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="alternativa" value="<?=$alt['nome']?>">
                                            <label class="form-check-label" for="alternativa">
                                            <?=$alt['nome']?></label>
                                            </div>
                                        <?php }

                                        } else { ?>
                                        
                                        <input name="resposta" required class="form-control">                               

                                        <?php }?>

                                    </div>

                                    <input type="hidden" name="idPerg" value="<?=$perg['id']?>">
                                    <input type="hidden" name="idVotacao" value="<?=$reuniao->getIdVotacao()?>">
                                   
                                    <button onclick="return verificarAlternativa();" type="submit" class="d-grid col-4 mx-auto btn btn-outline-primary btn-sm my-2">Votar</button>
                                    </form>            
                                  </div>

                            </div>
                            <?php }  ?>
                        <?php } ?>              

                      </div>

                   </div>
                  </div>
                </div>

                <!-- LISTA PRESENCA  -->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Lista de Presença
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  
                   
                      <div class="accordion-body">

                      <table class="table table-sm table-hover">
                      <thead>
                        <tr><!-- 
                          <th scope="col">Matrícula</th> -->
                          <th scope="col">Nome</th>
                          <th scope="col">Status</th>            
                        </tr>
                      </thead>
                      <tbody>

                      <?php foreach (ListaPresencaDAO::mostrarListaPresenca($reuniao->getIdListapresenca()) as $val){
                      ?>
                          <tr>
                          <!-- MOSTRA LOGIN, NOME E STATUS DO USUARIO NA REUNIÃO-->
                            <!-- <th scope='row'><?= $val['id_usuario'] ?></th> -->
                            <td><?= $val['nome'] ?></td> 
                            <?php

                            if($val['convidado'] == 1){
                              echo "<td class='text-warning'>Convidado</td>";
                            }
                            else if($val['presente'] == 0){
                              echo "<td class='text-black'>Ausente</td>";
                            }
                            else{
                              echo "<td class='text-success fw-bold'>Presente</td>";
                            }

                            ?>
                          </tr>
                        <?php } ?>                       
                      </tbody>
                    </table>


                    <!-- SE O USUARIO AINDA NAO SE MARCOU COMO PRESENTE, MOSTRA BOTAO. SENAO, NAO MOSTRA.  -->


                    <!-- BOTÃO -->
                    <a href="confirmarPresenca.php?id=<?=$idReuniao?>" class="btn btn-primary">Marcar Presença</a>
                      
                    </div>
                    

                  </div>
                </div>
            </div>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    </script>
    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

  </body>
</html>
<?php } ?>