

  <!--navbar do sistema-->

  <?php include_once("head.html"); ?>

  <!--fim navbar do sistema-->



<main>

	<H1 class="padi" >Postar Obra</H1>

	<form class="padi" method="post" action="../../Controller/postObra.php">



				<div class = "justify-content-center"">

					<label for="ifsn">IFSN</label>

					<input type="text" placeholder="IFSN" id="ifsn" name="ifsn"/>

				</div>



				<div>

					<label for="titulo">Titulo</label>  

					<input type="text" placeholder="Titulo" id="titulo" name="titulo"/>

				</div>

	<div>

					<label for="autor">Autor</label>

					<input type="text" placeholder="Autor" id="autor" name="autor"/>

				</div>

				<div>

					<label for="area">Area</label> 

					<input type="text" placeholder="Area" id="area" name="area"/>

				</div>



				<div>

					<label for="descricao">Descrição</label>  
					<textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea> 

				</div>


			
<div class="form-group"> <label for="exampleFormControlFile1"></label> <input type="file" class="form-control-file" id="exampleFormControlFile1" name="nome_arquivo"> </div>


				<button>Enviar</button>



			</form>

		</main>

  <!--footer do sistema-->
  <?php include_once("footer.html"); ?>
  <!--fim footer do sistema-->

