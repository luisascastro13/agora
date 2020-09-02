<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    right: 100%;
    width: 100%;
    padding-right: 1rem;
    padding-left: 1rem;
    overflow-y: auto;
    visibility: hidden;
    background-color: black;
    transition: visibility .2s ease-in-out, transform .2s ease-in-out;
  }
  .navbar-collapse.show {
    visibility: visible;
    transform: translateX(100%);
  }
}

</style>
</head>
<body>

  <?php

  session_start();

  // echo 'Primeiro nome: '.$_SESSION['primeironome'];
  // echo '<br>Nome completo: '.$_SESSION['nomecompleto'];
  // echo '<br>IDUsuario: '.$_SESSION['userid'];
  // echo '<br>Url da Foto do Usuário: '.$_SESSION['urlfoto'];

  // echo '<br><a href="login.php">VOLTAR</a>';

  ?>


<!-- ========================= SECTION CONTENT ========================= -->

<div class="">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-trigger="#main_nav">
    <span class="navbar-toggler-icon"></span>
  </button>
<div class="navbar-collapse" id="main_nav">

<div class="offcanvas-header mt-3">  
	<button class="btn btn-outline-danger btn-close float-right"> &times Close </button>
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

<section class="section-content py-5">

		<h6>Demo view: Navbar collapse to off canvas on mobile. <span class="text-danger">Change browser size to see in action</span> </h6>
    <p>For this demo page you should connect to the internet to receive files from CDN  like Bootstrap CSS, Bootstrap JS and jQuery. </p>
		
    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>

		<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>

		<a href="http://bootstrap-menu.com/detail-offcanvas-collapse.html" class="btn btn-warning"> &laquo Back to tutorial or Download code</a>

</section>

</div><!-- container //  -->

</body>
</html>