<!--navbar do sistema-->
<?php include_once("head.html"); ?>
<!--fim navbar do sistema-->

<main>
	<H1 class="d-flex justify-content-center menoss" >Postar trabalho</H1>

	<div class="container maiss">
		<div class="row justify-content-center d-flex">
			<form class="form-goup col-10 col-md-10 col-sm-10 col-lg-10 col-xl-9" method="POST" action="../Controller/postObra.php">
				<div class="mb-2">
					<label for="titulo" class="form-label">Título</label>  
					<input type="text" class="form-control form-control-sm" placeholder="Título" id="titulo" name="titulo" autocomplete="off" required/>
				</div>

				<div class="mb-2 row">
					<span  class="col-lg-4 col-sm-4 col-4 col-md-4">
						<label for="ifsn" class="form-label">IFSN</label>
						<input  type="text" class="form-control form-control-sm" placeholder="IFSN" id="ifsn" name="ifsn" autocomplete="off" required/>
					</span>
					<span class="col-lg-4 col-sm-4 col-4 col-md-4">
						<label for="area" class="form-label">Área</label> 
						<input type="text" class="form-control form-control-sm" placeholder="Área" id="area" name="area" autocomplete="off"/>
					</span>
					<span class="col-lg-4 col-sm-4 col-4 col-md-4">
						<label for="area" class="form-label">Ano</label> 
						<input type="number" class="form-control form-control-sm" placeholder="Ano" id="ano" name="ano" autocomplete="off"/>
					</span>
				</div>

				<div class="mb-2  input-group-sm">
					<label for="descricao" class="form-label">Descrição</label>  
					<textarea class="form-control" class="form-control form-control-sm" id="descricao" name="descricao" rows="3" autocomplete="off"></textarea> 
				</div>
			
				<div class="row mb-2">
					<span class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<label for="autor" class="form-label">Autor 1</label>
						<input type="text" class="form-control form-control-sm" placeholder="Nome do(a) autor(a)" id="autor" name="autor" autocomplete="off"/>
					</span>	
					<span class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<label for="autor" class="form-label">Autor 2 (se houver)</label>
						<input type="text" class="form-control form-control-sm" placeholder="Nome do(a) autor(a)" id="autor2" name="autor2" autocomplete="off"/>
					</span>	
				</div>

				<div class="mb-2 row">	
					<span class="" style="max-width: 180px;">
						<label for="input-arquivo" class="botao-file" style="padding: 5px 17px; margin-top: 5px;">Escolher arquivo</label>	
						<input type="file" id="input-arquivo" name="arquivo" accept=".pdf, .doc, .docx" style="display: none;">
					</span> 
					<span class="col-7 col-md-8 col-sm-8 col-lg-8 col-xl-8">
						<div id="status-do-envio" style="margin-top: 5px; font-size: 1.45em"></div>
					</span>
				</div>

				<div class="mb-2 row">
					<input type="text" id="nameFile" style="display: none;" name="nome_arquivo">
					<input type="text" id="pathFile" style="display: none;" name="caminho_arquivo">
				</div>
			
				<div class="justify-content-center d-flex">
					<button type="submit" style="padding: 5px 100px;" class="btn botao-enviar bgVerde txtBranco">Enviar</button>
				</div>

			</form>
		</div>
	</div>

</main>

<script src="../Controller/uploadArquivo.js"></script>

<?php include_once "footer.html";?>