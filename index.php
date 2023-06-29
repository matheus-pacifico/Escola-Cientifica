<!DOCTYPE html>
<html lang="pt-br">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escola Científica</title>

  <link rel="stylesheet" href="View/Style/bootstrap-5.3.0/css/bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="View/Style/bootstrap-5.3.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="View/Style/style.css" type="text/css">
  <link rel="shortcut icon" href="View/Images/icone.png">
</head>
  	
<?php
	require_once("Controller/getObras.php");
	if(!empty($_GET['q'])) {
	    $resultado = getSearchedObras($_GET['q']);
	} else {
	    $resultado = null;
	}
?>

<body class="bgCinza">
  <header>
    <nav class="navbar navbar-dark bgVerde">
      <div class="container-fluid txtBranco">
        <a class="navbar-brand navSans navA" href="#">
          <img src="View/Images/icone.png" style="padding-top: 3px;" alt="Logo Escola Científica" width="30" height="33" class="d-inline-block align-text-top">
          Escola Científica
        </a>

        <button class="navbar-toggler txtBranco borda-botoao-nav" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" style="border-color: #DEE2E6 !important;" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon txtBranco" style="color: white !important;"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <span><a class="nav-link active txtBranco" href="#">Home</a></span>
            <span><a class="nav-link active txtBranco" href="obra/postar.php">Postar Obra</a></span>
            <span><a class="nav-link active txtBranco" href="obra/gerenciar.php">Gerenciar Obras</a></span>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main>

  	<div class="container">
  		<div class="justify-content-center d-flex">
			<div class="box-search d-flex col-12 col-sm-11 col-md-9 col-lg-6 col-xl-6 margemb">
			  <input type="search" class="form-control" name="busca" id="buscar-input" placeholder="Pesquisar">
			  <button class="btn txtVerde bgBranco" id="buscar-button" onclick="pesquisar()"> 
			  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
			    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
			  </svg>
			  </button>
			</div>
		</div>
	</div>

	  <div class="container afastarTopo">

	    <div class="row d-flex justify-content-center">
		    <?php if($resultado != null && !empty($resultado->content)) {
		       foreach ($resultado->content as $obraObjeto) { 
		    ?>

	          <div class="col-md-10 col-sm-3 card-index-search borda">   
	            <div class="card">
	              <div class="card-body">
	                <h5 class="card-title tituloObra"><a class="tituloObra" href="#" action=""><?php echo $obraObjeto->titulo . " "; ?></a></h5>
	                <h6 class="card-subtitle mb-2 text-muted">
	                  <?php 
	                    echo "IFSN: " . $obraObjeto->ifsn . '<span class="margemDireita"></span>';
	                    echo "    área: " . $obraObjeto->area . '<span class="margemDireita"></span>'; 
	                    echo "    autor(es): "; 
	                    echo nomeAutoresFormatado($obraObjeto->autores) . '<span class="margemDireita"></span>';
	                    echo "ano: " . $obraObjeto->ano;
	                  ?>
	                </h6>

	              <div class="card-text">
	                <?php echo descricaoLimitada($obraObjeto->descricao); ?>
	              </div>

	              <a href="<?php echo $_ENV['URL_BASE'] . 'obra/arquivo/download/'. $obraObjeto->ifsn;?>" class="card-link txtVerde linkVerde">
	              	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
	              </a>
	            </div>

	          </div>

	        </div>

	        <?php
	        }

	      } else if($resultado != null) { ?>

	    <div style="text-align: center; height: 23em;">
	      <h2>Nenhum Resultado encontrado!</h2>
	    </div>

	    <?php 
	      } else {
	    ?> <div>
	        <span></span>
	        </div>
	    <?php
	      }    
	    ?>
	  </div>
	</div>

  </main>

  <script>
    let busca = window.document.getElementById("buscar-input");
    
    busca.addEventListener("keydown", function(event) {
      if(event.key ==="Enter") {
        pesquisar();
      }
    });

    function pesquisar() {
      window.location = "index.php?q=" + busca.value;
    }

  </script>

  <?php include_once("obra/footer.html");?>