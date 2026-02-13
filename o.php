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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..20,300..500;1,14..18,300..500&family=Open+Sans:wght@400..700&display=swap" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
  	
<?php
	require_once("controller/getObras.php");
  $API_URL = require_once("controller/get_api_url.php");

	$ifsn = $_GET['ifsn'] ?? null;
	$resultado = null;
  $impDV = '';
	if ($ifsn != null) {
		$resultado = (trim($ifsn) !== '') ? getObraByIfsn($_GET['ifsn']) : '';
	}
?>

<body>
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
            <span><a class="nav-link active txtBranco" href="/obras/postar">Postar Obra</a></span>
            <span><a class="nav-link active txtBranco" href="/obras/gerenciar">Gerenciar Obras</a></span>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <div class="container" style="margin-top:2px;margin-bottom:10px">
	    <div class="row d-flex justify-content-center">

		    <?php if($resultado != null && !empty($resultado) && !isset($resultado->error)) {
		       $obraObjeto = $resultado;
		    ?>

	          <div class="col-md-10 col-xl-9 card-index-search borda">   
	            <div class="card">
	              <div class="card-body">
                  <h5 class="card-title txtVerde mb-2" style="font-size: 1.2rem;font-weight:500;
  font-family: 'Open Sans', sans-serif;"><?php echo scape_html_tags($obraObjeto->titulo); ?></h5>
                  <h6 class="card-subtitle mb-2" style="margin-top: -5px; color: rgba(42,42,42, 0.89) !important;" id="nome-autores"><?php 
					scape_html_tags(nomeAutores($obraObjeto->autores)); 
                  ?></h6>
                  <div class="d-inline-flex gap-4" style="margin-top:18px">
                    <div class="atributo-container">
                      <div class="atributo-label">IFSN</div>
                      <div class="atributo-valor"><?php echo scape_html_tags($obraObjeto->ifsn); ?></div>
                    </div>
                    <div class="atributo-container">
                      <div class="atributo-label">Área</div>
                      <div class="atributo-valor"><?php echo scape_html_tags($obraObjeto->area); ?></div>
                    </div>
                    <div class="atributo-container">
                      <div class="atributo-label">Ano</div>
                      <div class="atributo-valor"><?php echo scape_html_tags($obraObjeto->ano); ?></div>
                    </div>
                  </div>
                  <div class="mt-3">
                    <div class="atributo-label">Descrição</div>
                  	<div style="color:#313131;line-height:1.32;" class="card-text"><?php echo nl2br(scape_html_tags($obraObjeto->descricao)); ?></div>
				  </div>   
                  <div class="botoes-acao">
                    <div id="download-btn-div">
                      <button id="download-btn" class="btn-download" onclick="downloadPDF()">
                        <span id="download-btn-content">
                          <svg width="18" height="18" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                              <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                              <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                          </svg>
                          <span id="toggleTextDownload">Baixar PDF</span>
                        </span>
                        <span id="spinner-download" class="download-spinner" style="display:none"></span>
                      </button>
                      <div id="download-error">Erro ao baixar o arquivo</div>
                    </div>
                    <div>
                      <button class="btn-visualizar" onclick="toggleViewer()" id="toggleBtn">
                        <svg id="eye-open" width="18" height="18" fill="currentColor" class="bi bi-eye toggle-icon active" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>
                        <svg id="eye-closed" width="18" height="18" fill="currentColor" class="bi bi-eye-slash toggle-icon" viewBox="0 0 16 16">
                          <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                          <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                          <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.708zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                        </svg>
                        <span id="toggleTextSee">Ver Online</span>
                      </button>
                    </div>
                  </div>
              
                  <div id="pdf-viewer" class="pdf-viewer-container">     
                    <div id="pdf-loading" class="pdf-loading-overlay hidden">
                      <div class="loading-spinner"></div>
                      <div class="loading-text">Carregando PDF</div>
                    </div>
                    <div id="pdf-loading-error" class="pdf-loading-overlay hidden">
           <?php         /*<! -- <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#C8191E" style="margin-bottom:15px"><path d="m251.33-204.67-46.66-46.66L433.33-480 204.67-708.67l46.66-46.66L480-526.67l228.67-228.66 46.66 46.66L526.67-480l228.66 228.67-46.66 46.66L480-433.33 251.33-204.67Z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="200 -760 560 560" width="40px" fill="#C8191E" style="margin-bottom:15px">
  <path d="m251.33-204.67-46.66-46.66L433.33-480 204.67-708.67l46.66-46.66L480-526.67l228.67-228.66 46.66 46.66L526.67-480l228.66 228.67-46.66 46.66L480-433.33 251.33-204.67Z"/>-- > 
</svg>*/ ?>
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="4 5 16 14" width="40px" fill="#C8191E" style="margin-bottom:15px">
  <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
</svg>
                      <div class="loading-text">Erro ao carregar PDF</div>
                    </div>
                    <iframe id="pdf-iframe" src="" style="width:100%; height:100%; border:none;"></iframe>
                  </div>
                  <?php $impDV='<script>const ifsn=' . json_encode(scape_html_tags($obraObjeto->ifsn)) .
                    ',pU=' . json_encode($API_URL . 'arquivo/download/'. scape_html_tags($obraObjeto->arquivo->idArquivo)) . ';</script>' . 
                    '<script src="public/js/download-or-view.js"></script>';
                    ?>
	              </div>
	            </div>
            </div>
	        <?php
	      } else { ?>

	    <div style="text-align: center; height: 100%;">
	      <h2 style=" margin-top:2.8em">Obra não encontrada!</h2>
        <p>O link em que você clicou pode não estar funcionando, ou a obra pode ter sido removida.</p>
	    </div>

	    <?php
	      }    
	    ?>
      </div>
    </div>
  </main>

<?php 
echo $impDV;
include_once("obras/footer.html");
?>    
