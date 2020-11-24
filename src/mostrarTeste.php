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

<body>
    <div class="row">

            <nav class="col-12 navbar navbar-expand-md navbar navbar-light bg-light sticky-top d-block d-sm-none d-none d-sm-block p-0 d-md-none" id="nav">
                    <img src="LogoTextoCaneta.svg" alt="" loading="lazy" id="logo" class="ml-3">
            </nav>
            
        </div>

    <div class="wrapper">

        
        <!-- Sidebar  -->
        <nav id="sidebar" style="background-color: #127681;" class="border-right border-warning d-none d-sm-block">
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

        </nav>


        


        <!-- Page Content  -->
        <div id="content" class="pt-0">

            <nav class="navbar navbar-expand-lg navbar-light bg-light d-none d-md-block d-lg-none d-none d-lg-block d-xl-none d-none d-xl-block">
                <div class="container-fluid d-none d-md-block d-lg-none d-none d-lg-block d-xl-none d-none d-xl-block">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Menu</span>
                    </button>  
                    <input type="text">
                    <button class="btn btn-info"><i class="fas fa-search"></i></button>
                </div>
            </nav>

            <!-- row que ocupa todo o espaço da tela -->
            <div class="row">

                <div class="col-lg-8 col-sm">
                    <!-- nucleos -->
                    <div class="d-none d-sm-block">
                        <div class="row">
                            <div class="col-8 h5">Título</div>
                            <div class="col-4 btn btn-info btn-sm">Ver Todos</div>
                        </div>
                        <div class="ml-3">
                            <div class="row mt-2">
                                <div class="col-6 rounded bg-warning mr-3">
                                    <span> Nucleo1 </span>
                                    <i class="fas fa-caret-right float-right"></i>
                                </div>
                                <div class="col rounded bg-warning">
                                    <span> Nucleo2 </span>
                                    <i class="fas fa-caret-right float-right"></i>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-6 rounded bg-warning mr-3">
                                    <span> Nucleo3 </span>
                                    <i class="fas fa-caret-right float-right"></i>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <!-- documentos recentes -->
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-8 h5">Título</div>
                            <div class="col-4 btn btn-info btn-sm">Ver Todos</div>
                        </div>

                        <div class="mt-3">
                            <div class="row">
                                <div class="col-3">
                                    
                                    <div class="card">
                                      <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                                      <div class="card-body">
                                        <p class="card-text">Ata X</p>
                                      </div>
                                    </div>

                                </div>


                                <div class="col-3">

                                    <div class="card">
                                      <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                                      <div class="card-body">
                                        <p class="card-text">Ata X</p>
                                      </div>
                                    </div>                    

                                </div>
                                <div class="col-3">
                                    
                                    <div class="card">
                                      <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                                      <div class="card-body">
                                        <p class="card-text">Ata X</p>
                                      </div>
                                    </div>

                                </div>
                                <div class="col-3">
                                    
                                    <div class="card">
                                      <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                                      <div class="card-body">
                                        <p class="card-text">Ata X</p>
                                      </div>
                                    </div>

                                </div>
                                
                            </div>
                            <div class="row mt-3">
                                <div class="col-3  d-none d-md-block">
                                    
                                    <div class="card">
                                      <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                                      <div class="card-body">
                                        <p class="card-text">Ata X</p>
                                      </div>
                                    </div>

                                </div>
                                <div class="col-3 d-none d-md-block">
                                    
                                    <div class="card">
                                      <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                                      <div class="card-body">
                                        <p class="card-text">Ata X</p>
                                      </div>
                                    </div>

                                </div>
                                <div class="col-3 d-none d-md-block">
                                    
                                    <div class="card">
                                      <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                                      <div class="card-body">
                                        <p class="card-text">Ata X</p>
                                      </div>
                                    </div>

                                </div>
                                <div class="col-3 d-none d-md-block">
                                    
                                    <div class="card">
                                      <img class="card-img-top" src="amarelo.jpg" alt="Card image cap">
                                      <div class="card-body">
                                        <p class="card-text">Ata X</p>
                                      </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm">
                    <!-- calendario -->
                    <div class="d-none d-sm-block">                        
                        <span>Calendário</span>
                        <div>
                            1 2 3 4 5 6 7
                            <br>1 2 3 4 5 6 7
                            <br>1 2 3 4 5 6 7
                            <br>1 2 3 4 5 6 7                        


                        </div>                        
                    </div>

                    <!-- proximos eventos -->
                    <div class="col-sm-">
                        <div>

                            <div class="card">
                                <div class="card-body border-left border-warning">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title">12/09</h5>
                                        </div>
                                        <div class="col">
                                            <p class="card-subtitle mb-2 text-muted">NúcleoX</p>
                                        </div>
                                        <div class="col">
                                           <i class="fas fa-ellipsis-v"></i> 
                                        </div>                                                   
                                    </div>
                                    <p class="card-text">EventoY</p>
                              </div>
                            </div>

                        </div>

                        <div>
                            
                           <div class="card">
                                <div class="card-body  border-left border-warning">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title">12/09</h5>
                                        </div>
                                        <div class="col">
                                            <p class="card-text">NúcleoX</p>
                                        </div>
                                        <div class="col">
                                           <i class="fas fa-ellipsis-v"></i> 
                                        </div>                                                   
                                    </div>
                                    <p class="card-text">EventoY</p>
                              </div>
                            </div>                           

                        </div>

                        <div>

                            <div class="card">
                                <div class="card-body  border-left border-warning">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title">12/09</h5>
                                        </div>
                                        <div class="col">
                                            <p class="card-text">NúcleoX</p>
                                        </div>
                                        <div class="col">
                                           <i class="fas fa-ellipsis-v"></i> 
                                        </div>                                                   
                                    </div>
                                    <p class="card-text">EventoY</p>
                              </div>
                            </div>


                        </div>
                    </div>     

                    <div class="btn btn-info d-block btn-sm mt-3">Ver Todos</div>           
                </div>

            </div>
        </div>
    </div>
    <div class="btn-group navbar fixed-bottom w-100 d-block d-sm-none d-none d-sm-block d-md-none bg-info pb-0 m-0" style="border-top: 1px solid transparent;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);">
        <div class="d-flex justify-content-around bg-info">
            <div type="button" class="btn btn-secondary bg-info border-0">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-list bg-info" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </div>
            <div type="button" class="btn btn-secondary  bg-info border-0">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-collection bg-info" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"/>
                </svg>

            </div>
            <div type="button" class="btn btn-secondary  bg-info border-0">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus-circle bg-info" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </div>
            <div type="button" class="btn btn-secondary bg-info border-0">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search bg-info" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                </svg>
            </div>
            <div type="button" class="btn btn-secondary bg-info border-0">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-fill bg-info" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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

        if ($('#sidebar').hasClass('active')) {
            $('#sidebar').toggleClass('d-none d-md-block d-lg-none d-none d-lg-block d-xl-none d-none d-xl-block');
            };
    </script>
</body>

</html>