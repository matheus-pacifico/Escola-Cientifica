<!DOCTYPE html>
<html lang="pt-br">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escola Científica</title>
  <link rel="icon" type="image/x-icon" href="/favicon.ico">

  <link rel="icon" type="image/png" sizes="512x512" href="/android-chrome-512x512.png">
  <link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="manifest.json">

  <script>if(window.location.search.includes("i=")){let e=window.location.search.replace(/[\?&]i=[^&]+(&|$)/g,function(e,a){return e.endsWith("&")?"&":""}).replace(/^\?&/,"?").replace(/^\?$/,"");e?window.history.replaceState({},document.title,window.location.pathname+e):window.history.replaceState({},document.title,window.location.pathname)}if(location.pathname.endsWith("/")&&location.search){let a=location.pathname.replace(/\/$/,"")+location.search;history.replaceState(null,"",a)}</script>
  <link rel="stylesheet" href="public/css/style.css" type="text/css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..20,300..500;1,14..18,300..500&family=Open+Sans:wght@400..700&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</head>
  	
<?php

  $q = $_GET['q'] ?? null;
  $resultado = null;
  $API_URL = require_once("controller/get_api_url.php");
  if ($q === null) {
    $API_URL = null;
  }

  if ($q != null) {
	  require_once("controller/getObras.php");
    $resultado = (trim($q) !== '') ? getSearchedObras(rawurlencode(trim($q))) : (object) ['content' => []];
    if ($resultado === null || empty($resultado->content)) {
      $API_URL = null;
    }
  }
?>

<body class="bgCinza">
  <header>
    <nav class="navbar navbar-dark bgVerde">
      <div class="container-fluid txtBranco">
        <a class="navbar-brand navSans navA" href="/">
          <img src="public/img/icone.png" alt="Logo Escola Científica" width="30" height="30" class="d-inline-block align-text-top">
          <span>Escola Científica</span>
        </a>

        <button class="navbar-toggler txtBranco borda-botoao-nav" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" style="border-color: #DEE2E6 !important;" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon txtBranco"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <span><a class="nav-link active txtBranco" href="obras/postar">Postar Obra</a></span>
            <span><a class="nav-link active txtBranco" href="obras/gerenciar">Gerenciar Obras</a></span>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main>

  	<div class="container" style="margin-bottom:10px">
  		<div class="justify-content-center d-flex">
        <div class="box-search d-flex col-12 col-sm-11 col-md-9 col-lg-6 col-xl-6 margemb">
          <input type="search" class="form-control" name="busca" id="buscar-input" placeholder="Pesquisar">
          <button id="buscar-button" class="btn txtVerde bgBranco" onclick="p()">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg>
          </button>
        </div>
		  </div>
	    <div class="row d-flex justify-content-center" style="margin-top:17px">

		    <?php 
        if($API_URL != null) {
		      foreach ($resultado->content as $obraObjeto) { 
		    ?>

	          <div class="col-md-10 col-xl-9 card-index-search borda">   
	            <div class="card">
	              <div class="card-body">
	                <h5 class="card-title tituloObra"><a class="tituloObra" href="<?php echo '/o/' . scape_html_tags($obraObjeto->ifsn); ?>" action=""><?php echo scape_html_tags($obraObjeto->titulo);?></a></h5>
	                <h6 class="card-subtitle mb-2" style="color:rgb(42 42 42 / 89%) !important"><?php 
	                    echo scape_html_tags($obraObjeto->ifsn) . ", " . scape_html_tags($obraObjeto->area) . ", ";
                      echo scape_html_tags(nomeAutoresFormatado($obraObjeto->autores)) . (numeroAutores($obraObjeto->autores) > 1 ? " " : ", ") . scape_html_tags($obraObjeto->ano);
	                  ?></h6>

                  <div class="card-text descricao-search" style="margin-bottom:4px; line-height:1.31;"><?php 
                  echo descricaoLimitada(scape_html_tags($obraObjeto->descricao)); 
                ?></div>
                  <button class="card-link txtVerde linkVerde botao-download" title="Baixar trabalho" onclick="downloadPDF('<?php echo scape_html_tags($obraObjeto->ifsn) . "', '" . $API_URL . "arquivo/download/" . scape_html_tags($obraObjeto->idArquivo); ?>')" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                      <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg>
                  </button>
	              </div>
              </div>
            </div>

	        <?php
	        }?>
          
        <script src="/public/js/download.js"></script>
<?php
	      } else if($resultado != null) { ?>

	    <div style="text-align: center; height: 23em;">
	      <h2>Nenhum resultado encontrado!</h2>
	    </div>

	    <?php 
	      }  
	    ?>
	    </div>
	  </div>
  </main>

 <script>const busca=window.document.getElementById("buscar-input"),buscar_btn=window.document.getElementById("buscar-button");busca.value=<?php echo json_encode($_GET['q']);?>;function p(){""!==busca.value&&(busca.blur(),window.location="search?q="+encodeURIComponent(busca.value).replace(/%20/g,"+"))}busca.addEventListener("keydown",(function(n){"Enter"===n.key&&p()}));</script>

<?php include_once("obras/footer.html");?>
