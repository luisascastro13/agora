<?php
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
                    <li class="breadcrumb-item"><a href="visualizarReuniao.php?id=<?=$idReuniao?>">Reunião</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalhes da Reunião</li>
                  </ol>
                </nav>
              </div>
              <div>
                <h1><?=$reuniao->getNome()?></h1>
              </div>   
              <h2>Data: <?=$dataFormatada?></h2>          
            </div>


            <span>Compartilhe essa reunião!</span>
            <div class="">                       
              <?php $urlencoded = urlencode("http://localhost/agora/src/app/view/visualizarReuniao.php?id=<?=$idReuniao?>"); ?>

              <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?=$urlencoded?>&amp;size=100x100" alt="" title="" />
            </div>

            <?php if($userAdm == true){ ?>
             
              <button type="button" class="btn btn-outline-warning btn-sm" onClick="deletarReuniao()">Deletar reunião</button>          

              <form style="display: none" id='myForm' method="post" action="../controller/Reuniao.controller.php?a=excluir&id=<?=$idReuniao?>">
              <input type="submit">
              </form>


              
            <?php }  ?>                        

            

        <!-- fecha o conteudo da pagina -->
        </div>

      <!-- fecha a row da tela toda -->
        </div>
    <!-- fecha o container grandao da pagina     -->
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    </script>
    
    <script>

      function deletarReuniao(){
      Swal.fire({
        title: "Você tem certeza?",
        text: "Você não poderá reverter essa ação posteriormente.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, quero excluir.',
        cancelButtonText: 'Não, manter reunião.'
      }).then((result) => {
        if (result.isConfirmed){
          Swal.fire('Reunião excluída!', '', 'success');         
        document.getElementById("myForm").submit();
        }
      })  

  }
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

  </body>
</html>
<?php } ?>