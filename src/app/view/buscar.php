<?php

require_once '../model/Conexao.class.php';
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
?>

<!DOCTYPE html>
<html>
<?php include('template/head.php'); ?>
<head>
	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<!-- container grandao da pagina -->
<div class="container-fluid m-0 p-0">

	<!-- TELA TODA -->
    <div class="row p-0 m-0">

		<?php include('template/navbarPequenos.php'); ?>
		<?php include('template/navbarGrandes.php'); ?>	

        <!-- CONTEÚDO DA PÁGINA -->
	    <div id="pagina" class="container-fluid pl-md-4">

			<div>
		    <br>
		    <input id="entrada" type="txt" class="form-control" placeholder="Pesquisar núcleo">
		    
		    <hr>
		    <strong id="quantidade"></strong>
		    <span id="saidaTxt">Nenhum resultado...</span>
        <input type='hidden' id='nomeNucleo'>
        <br><br>
		    </div>	   

		<!-- fecha o conteudo da pagina -->
		</div>

	<!-- fecha a row da tela toda -->
    </div>
<!-- fecha o container grandao da pagina     -->
</div>
</body>
</html>

<script>


// Code goes here
var busca = null;
var array = <?php echo NucleoDAO::mostrarTodosNucleosEmString() ?>;
console.log(array);

$(document).ready(function(){
  $('#entrada').bind('input',function(){
    busca = $(this).val().toLowerCase();
    
    if(busca !== ''){
      var corresponde = false;
      var saida = Array();
      var quantidade = 0;
      for(var key in array){
        
        corresponde = array[key].toLowerCase().indexOf(busca) >= 0;
        if(corresponde){
          saida.push(array[key]);
          quantidade += 1;
        }
      }
      if(quantidade){        
        $('#saidaTxt').text('');
        $('#quantidade').html(quantidade+' resultados<br><br>');
        for(var ind in saida){
          var res = saida[ind].split(":");
          var nomeNucleo = res[1];
          var idNucleo = res[0];
          var url = "visualizarNucleo.php?id=";
          var urlCompleta = url.concat(idNucleo);

          $('#saidaTxt').append('<a href="'+urlCompleta+'">'+nomeNucleo+'</a>'+'<br>');
        }

        
      }else{
        $('#quantidade').html('');
        $('#saidaTxt').text('Nenhum resultado...');
      }
    
    } else{
      $('#quantidade').html('');
      $('#saidaTxt').text('Nenhum resultado...');
    }
        
  });
});

</script>

<?php } ?>