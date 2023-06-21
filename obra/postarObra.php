<!--navbar do sistema-->
<?php include_once("head.html"); ?>
<!--fim navbar do sistema-->

<main>
	<div class="form-control container postarO d-flex justify-content-center">
		<div class="col-md-10 col-sm-3">
			<H1 class="padi d-flex justify-content-center" >Postar Obra</H1>

			<form class="form-control padi justify-content-center" method="post" action="../Controller/postObra.php">

				<div class="d-flex justify-content-center form-group">
					<label for="ifsn">IFSN</label>
					<input type="text" placeholder="IFSN" id="ifsn" name="ifsn"/>
				</div>

				<div class="d-flex justify-content-center form-group">
					<label for="titulo">Titulo</label>  
					<input type="text" placeholder="Titulo" id="titulo" name="titulo"/>
				</div>

				<div class="d-flex justify-content-center">
					<label for="autor">Autor</label>
					<input type="text" placeholder="Autor" id="autor" name="autor"/>
				</div>

				<div class="d-flex justify-content-center">
					<label for="area">Área</label> 
					<input type="text" placeholder="Área" id="area" name="area"/>
				</div>

				<div class="d-flex justify-content-center">
					<label for="area">Ano</label> 
					<input type="number" placeholder="Ano" id="ano" name="ano"/>
				</div>

				<div class="d-flex justify-content-center">
					<label for="descricao">Descrição</label>  
					<textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea> 
				</div>
			
				<div class="form-group"> <label for="exampleFormControlFile1"></label> <input type="file" class="form-control-file" id="exampleFormControlFile1" name="nome_arquivo"> </div>

				<button type="submit" class="btn btn-success">Enviar</button>
			</form>

		</div>
	</div>

</main>

<!--footer do sistema-->
<?php include_once("footer.html"); ?>
<!--fim footer do sistema-->