<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="htmlcss bootstrap menu, navbar, mega menu examples" />
<meta name="description" content="Bootstrap navbar examples for any type of project, Bootstrap 4" />  

<title>Demo - Bootstrap Navbar collapse to off canvas. html code example </title>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
crossorigin="anonymous"></script>

<!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>


<script type="text/javascript">
/// some script
$(function () {
	  'use strict'

	$("[data-trigger]").on("click", function(){
        var trigger_id =  $(this).attr('data-trigger');
        $(trigger_id).toggleClass("show");
        $('body').toggleClass("offcanvas-active");
    });

    // close if press ESC button 
    $(document).on('keydown', function(event) {
        if(event.keyCode === 27) {
           $(".navbar-collapse").removeClass("show");
           $("body").removeClass("overlay-active");
        }
    });

    // close button 
    $(".btn-close").click(function(e){
        $(".navbar-collapse").removeClass("show");
        $("body").removeClass("offcanvas-active");
    }); 


})
</script>

<style type="text/css">

body.offcanvas-active{
	overflow:hidden;
}
.offcanvas-header{ display:none; }

@media (max-width: 992px) {
  .offcanvas-header{ display:block; }
  .navbar-collapse {
    position: fixed;
    top:0; 
    bottom: 0;
    left: 100%;
    width: 100%;
    padding-right: 1rem;
    padding-left: 1rem;
    overflow-y: auto;
    visibility: hidden;
    background-color: #10375C;
    transition: visibility .2s ease-in-out, transform .2s ease-in-out;
  }
  .navbar-collapse.show {
    visibility: visible;
    transform: translateX(-100%);
  }
}

</style>
</head>
<body>

<header class="section-header">
<nav class="navbar navbar-expand-lg navbar-dark bg-light">
  <a class="navbar-brand text-secondary" href="#">

   ágora

  <!-- icone -->

  </a>

  <button class="navbar-toggler" type="button" data-trigger="#main_nav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse" id="main_nav">

<div class="offcanvas-header mt-3">  
  <button class="btn btn-outline-warning btn-close float-right"> &times Close </button>
  <h5 class="py-2 text-white">Main navbar</h5>
</div>

<ul class="navbar-nav">
  <li class="nav-item active"> <a class="nav-link" href="#">Home </a> </li>
  <li class="nav-item"><a class="nav-link" href="#"> About </a></li>
  <li class="nav-item"><a class="nav-link" href="#"> Services </a></li>
  <li class="nav-item dropdown">
    <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">  More items  </a>
      <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#"> Submenu item 1</a></li>
      <li><a class="dropdown-item" href="#"> Submenu item 2 </a></li>
      </ul>
  </li>
</ul>

<ul class="navbar-nav ml-auto">
  <li class="nav-item"><a class="nav-link" href="#"> Menu item </a></li>
  <li class="nav-item"><a class="nav-link" href="#"> Menu item </a></li>
  <li class="nav-item dropdown">
    <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown"> Dropdown right </a>
      <ul class="dropdown-menu dropdown-menu-right">
      <li><a class="dropdown-item" href="#"> Submenu item 1</a></li>
      <li><a class="dropdown-item" href="#"> Submenu item 2 </a></li>
      </ul>
  </li>
</ul>
  </div> <!-- navbar-collapse.// -->
</nav>

</header> <!-- section-header.// -->

<!-- ========================= SECTION CONTENT ========================= -->

<div class="container">

      <section class="section-content">

        <!-- docs recentes -->
        <div class="">

          <div class="row">
              <p>Documentos Recentes</p>
              <button type="button" class="btn btn-outline-info btn-sm">Ver todos
              </button>
          </div>

          <div class="row">
              <div class="col-6 col-sm-4 col-md-4 col-lg-2 col-xl-2">
              
                <div class="card" style="width: 100%;">
                  <img class="card-img-top" src="amarelo.jpg">
                    <div class="card-body">
                      <p class="card-text">AtaX</p>
                    </div>
                </div>

              </div>

              <div class="col-6 col-sm-4 col-md-4 col-lg-2 col-xl-2">
              
                <div class="card" style="width: 100%;">
                  <img class="card-img-top" src="amarelo.jpg">
                    <div class="card-body">
                      <p class="card-text">AtaX</p>
                    </div>
                </div>

              </div>

              <div class="d-none d-sm-block col-sm-4 col-md-4 col-lg-2 col-xl-2">
              
                <div class="card" style="width: 100%;">
                  <img class="card-img-top" src="amarelo.jpg">
                    <div class="card-body">
                      <p class="card-text">AtaX</p>
                    </div>
                </div>

              </div>

              <div class="d-none d-md-none d-lg-block col-lg-2 col-xl-2">
              
                <div class="card" style="width: 100%;">
                  <img class="card-img-top" src="amarelo.jpg">
                    <div class="card-body">
                      <p class="card-text">AtaX</p>
                    </div>
                </div>

              </div> 
              <div class="d-none d-md-none d-lg-block col-lg-2 col-xl-2">
              
                <div class="card" style="width: 100%;">
                  <img class="card-img-top" src="amarelo.jpg">
                    <div class="card-body">
                      <p class="card-text">AtaX</p>
                    </div>
                </div>

              </div> 
              <div class="d-none d-md-none d-lg-block col-lg-2 col-xl-2">
              
                <div class="card" style="width: 100%;">
                  <img class="card-img-top" src="amarelo.jpg">
                    <div class="card-body">
                      <p class="card-text">AtaX</p>
                    </div>
                </div>

              </div>         
          </div>

        </div>

        <!-- proximas reunioes -->
        <div>

        <div class="row">
              <p>Documentos Recentes</p>
              <button type="button" class="btn btn-outline-info btn-sm">Ver todos
              </button>
        </div>

        <div class="bg-primary">
          <div class="row">
            <div class="col-12">reuniaotal
            </div>
          </div>
          <div class="row">
            <div class="col-12">reuniaotal
            </div>
          </div>

        </div>
          
        
</div>

  	
      </section>

</div><!-- container //  -->


<nav class="navbar navbar-nav bg-info fixed-bottom d-block d-sm-none
d-none d-sm-block d-md-none d-none d-md-block d-lg-none m-0 p-0 py-2">

 <div class="btn-group d-flex justify-content-around bg-info m-0 p-0">

            <div type="button" class="btn btn-secondary  bg-info border-0">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-collection bg-info" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"/>
                </svg>

            </div>
            <div type="button" class="btn btn-secondary bg-info border-0">
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
           

</nav>

</body>
</html>