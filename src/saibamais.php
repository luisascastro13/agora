<!DOCTYPE html>
<html>
<head> 

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Ágora</title>    
    
    <!-- <script>
    
    window.onscroll = function() { myFunction()};

    function myFunction() {

        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            document.getElementById("nav").classList.add("test");
        } else {
            document.getElementById("nav").classList.remove("test");
        }
    }
    </script> -->

</head>
<body style="height: 100vh">


       <nav class="navbar navbar-expand-md navbar navbar-light bg-light sticky-top" id="nav">

                <a class="navbar-brand" href="index.php">

                    <img src="LogoTextoCaneta.svg" alt="" loading="lazy" id="logo">

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link">Saiba Mais</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Acompanhe</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Login</a>
                        </li>
                    </ul>
                </div>
        </nav>
      
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img class="d-block w-100" src="amarelo.jpg" alt="Primeiro Slide" style="height: 40vh;">

                    <div class="carousel-caption">
                        <h5>Dificuldade para elaborar a ata?</h5>
                        <p>Ágora te ajuda!</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="azulclaro.png" alt="Segundo Slide" style="height: 40vh;">
                    <div class="carousel-caption">
                        <h5>Demora para realizar votações?</h5>
                        <p>Ágora te ajuda!</p>
                    </div>
                </div>

                <div class="carousel-item">
                  <img class="d-block w-100" src="azulescuro.png" alt="Terceiro Slide" style="height: 40vh;">
                  <div class="carousel-caption">
                        <h5>Presenças incontroláveis?</h5>
                        <p>Ágora te ajuda!</p>
                    </div>
                </div>
          </div>

          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
          </a>

          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
          </a>
        </div>



        <section>
            <div class="container">

               <div class="row">
                        <div class="col-12 text-center mt-4">
                            <p class="align-center display-4">Recursos</p>
                        </div>
                </div>

                <div class="container">
                    <div class="row d-flex justify-content-center mt-4">
                        
                        <div class="card col-12 col-lg-3 border-0">
                            <div class="card-wrapper">
                                <div class="card-box align-center">
                                    <svg width="5em" height="5em" viewBox="0 0 16 16" class="bi bi-check-square d-block mx-auto mb-4" fill="#44A7B1" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                    </svg>
                                    <h5 class="card-title text-center"><strong>Votação</strong></h5>
                                    <p class="card-text text-center mb-4">Com Ágora, não há necessidade de perder tempo contando votos. Tenha números precisos e gráficos ilustrativos imediatamente ao encerrar a votação.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card col-12 col-lg-3 border-0 mx-5">
                            <div class="card-wrapper">
                                <div class="card-box text-center">
                                    <svg width="5em" height="5em" viewBox="0 0 16 16" class="bi bi-at d-block mx-auto mb-4" fill="#44A7B1" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"/>
                                    </svg>
                                    <h5 class="card-title align-center"><strong>Lista de Presença</strong></h5>
                                    <p class="card-text align-center mb-4">Evite o desperdício e poluição gerados por listas em papel. Otimize o controle de presenças com o sistema Ágora.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card col-12 col-lg-3 border-0">
                            <div class="card-wrapper">
                                <div class="card-box text-center">
                                    <svg width="5em" height="5em" viewBox="0 0 16 16" class="bi bi-file-earmark-text d-block mx-auto mb-4" fill="#44A7B1" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                        <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                    <h5 class="card-title align-center"><strong>Ata</strong></h5>
                                    <p class="card-text align-center mb-4">Ágora conta com modelos de ata para vários tipos de reunião além de disponibilizar as atas anteriores de forma online.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    </div>                    
            </div>
        </section>


        <!-- <section class="text-center mt-5">
                <hr class="w-75" style="background-color: #44A7B1;">
                <p class="font-italic">Tenha o controle da reunião em sua mão com Ágora.</p>
                <hr class="w-75" style="background-color: #44A7B1;">                       
        </section> -->

        <section class="mt-5">
            <div class="container w-75 mx-auto">

                <!-- <div class="row">
                    <div class="col-12 text-center">
                        <p class="align-center font-weight-bold" style="font-size: 2em;">Vantagens</p>
                    </div>
                </div> -->

               <div class="row mt-4">
                    <div class="col-2 my-auto text-center">
                        <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-check2-circle" fill="#44A7B1" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 13.5 8a.5.5 0 0 1 1 0 6.5 6.5 0 1 1-3.25-5.63.5.5 0 1 1-.5.865A5.472 5.472 0 0 0 8 2.5z"/>
                         </svg>                            
                    </div>
                    <div class="col-10 d-block pl-4 my-auto">
                        <strong><i>Software</i> gratuito.</strong>
                        Todas as funcionalidades são disponibilizadas sem nenhum custo.
                        <a href="#">Experimente já</a>                            
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-2 my-auto text-center">
                        <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-check2-circle" fill="#44A7B1" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 13.5 8a.5.5 0 0 1 1 0 6.5 6.5 0 1 1-3.25-5.63.5.5 0 1 1-.5.865A5.472 5.472 0 0 0 8 2.5z"/>
                         </svg>                            
                    </div>
                    <div class="col-10 d-block pl-4 my-auto">
                        <strong>Reuniões ilimitadas.</strong>
                        Organize todas reuniões sem preocupar-se com limite.
                        <a href="#">Experimente já</a>                            
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-2 my-auto text-center">
                        <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-check2-circle" fill="#44A7B1" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 13.5 8a.5.5 0 0 1 1 0 6.5 6.5 0 1 1-3.25-5.63.5.5 0 1 1-.5.865A5.472 5.472 0 0 0 8 2.5z"/>
                         </svg>                            
                    </div>
                    <div class="col-10 d-block pl-4 my-auto">
                        <strong>Sem <i>download</i>.</strong>
                        Basta um link para acessar em <i>smartphones, tablets</i> ou <i>notebooks</i>. 
                        <a href="#">Experimente já</a>                            
                    </div>
                </div>
            </div>
        </section>


        <footer class="footer mt-5 py-4" style="background-color: #0D4968;">
            <div class="container w-75 align-center text-center">
                <span class="text-muted">© Copyright 2020-2021 Ágora. All Rights Reserved.</span>
            </div>
        </footer>




      
   

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>