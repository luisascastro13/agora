<?php
require_once '../dao/Usuario.dao.php';
require_once '../dao/Nucleo.dao.php';
require_once '../model/Usuario.class.php';

$conn =  new Conexao();

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {
  
  // $_SESSION['conn'] = $conn;
  $usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);
  
  // echo $usuario->getNome() . '<br>'. $usuario->getLogin();

  if(isset($_GET['msg'])){
    switch($_GET['msg']){
      case '1':
      echo "<script>alert('Já existe núcleo com esse nome. Tente outro.')</script>";
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">

  <!-- Required meta tags -->
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

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
          <div id="pagina" class="container-fluid pl-md-4">


            <!-- SE EXISTE ALGUM DOCUMENTO RELACIONADO À REUNIAO, MOSTRAR ESSES ACCORDIONS DE ACORDO COM OS DOCUMENTOS EXISTENTES -->
            <div class="accordion" id="accordionExample">

              <!-- SE EXISTE ATA -->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Accordion Item #1
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                  </div>
                </div>

                <!-- SE EXISTE LISTA DE PRESENÇA -->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Accordion Item #2
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                  </div>
                </div>

                <!-- SE EXISTE VOTAÇÃO -->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Accordion Item #3
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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

 
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>
<?php } ?>