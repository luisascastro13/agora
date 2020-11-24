<?php

session_start();

    $primeironome = $_SESSION['primeironome'];
    $username = $_SESSION['username'];
    $urlfoto = $_SESSION['urlfoto'];
   
    // echo 'Primeiro nome: '.$_SESSION['primeironome'];

    // echo '<br>Nome completo: '.$_SESSION['nomecompleto'];

    // echo '<br>IDUsuario: '.$_SESSION['userid'];
    
    // echo '<br>Url da Foto do Usuário: '.$_SESSION['urlfoto'];

    // echo '<br><a href="login.html">VOLTAR</a>';

?>

<!DOCTYPE html>
<html>
<style>
    body{
        height: 100%;
    }
    </style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style4.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>
<style>
    * {
        font-size: 1.6em;
    }
</style>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" style="background-color: #127681;" class="border-right border-warning">
            <div class="sidebar-header" style="background-color: #127681;">
                <h3>
                    <img src="LogoTextoCaneta.svg">
                    <div class="mt-3 mb-3">
                        <img src="perfil.jpg" class="d-block rounded-circle border border-warning" style="width: 75px; height: 75px;">
                    </div>
                    <div><?php echo $primeironome; ?></div>
                    <div><?php echo $username; ?></div>
                    <hr>
                </h3>

                <strong>
                    <img src="caneta.svg" style="width: 75%; height: 75%;">
                </strong>
                
            </div>

            <ul class="list-unstyled components  mt-0">
                <li>
                    <a href="#">
                        <div class="">
                            <i class="fas fa-plus"></i>
                            <span>Criar</span>
                        </div>

                    </a>                 
                    
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-briefcase"></i>
                        Participar
                    </a>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        Pages
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-image"></i>
                        Galeria
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-cog"></i>
                        Configurações
                    </a>
                </li>
                <li>
                    <a href="#">
                       <i class="fas fa-sign-out-alt"></i>
                        Sair
                    </a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light d-none d-md-block d-lg-none d-none d-lg-block d-xl-none d-none d-xl-block">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Menu</span>
                    </button>  
                    <input type="text">
                    <button class="btn btn-info"></button>                          
                </div>
            </nav>

              

            <div class="row">
                <!-- BUSCA + NUCLEOS + DOCS RECENTES -->
                <div class="col-8">
                    <div class="row">
                        <span>Núcleos</span>
                        <button class="btn btn-info">Ver todos</button>
                    </div>
                    <div class="row">
                        <div class="col bg-secondary">
                            <span>Grêmio IFRS</span>
                        </div>
                        <div class="col bg-secondary">
                            <span>DS4</span>
                        </div>
                    </div>

                    <div style="max-height: 50">

                        <div class="row mt-5">
                            <span>Documentos Recentes</span>
                            <button class="btn btn-info">Ver todos</button>
                        </div>

                        <div class="card-deck">
                          <div class="card">
                            <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                            </div>
                          </div>
                          
                         <div class="card">
                            <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                            </div>
                          </div>

                          <div class="card">
                            <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                            </div>
                          </div>

                        </div>

                        <div class="card-deck">
                          <div class="card">
                            <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                            </div>
                          </div>
                          
                         <div class="card">
                            <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                            </div>
                          </div>

                          <div class="card">
                            <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                            </div>
                          </div>
                      </div>

                    </div>
                  


                </div>
                

                <!-- REUNIÕES DO MÊS -->
                <div class="col-4 bg-secondary">
                    
                </div>
            </div>     
        </div>
    </div>
    <div class="btn-group fixed-bottom w-100 d-block d-sm-none d-none d-sm-block d-md-none">
        <div class="d-flex justify-content-around">
            <div type="button" class="btn btn-secondary">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </div>
            <div type="button" class="btn btn-secondary">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-collection" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"/>
                </svg>

            </div>
            <div type="button" class="btn btn-secondary">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </div>
            <div type="button" class="btn btn-secondary">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                </svg>
            </div>
            <div type="button" class="btn btn-secondary">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>
            </div>  
      </div>      


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>