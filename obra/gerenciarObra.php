<?php include_once("head.html");
    include_once("../Controller/getObras.php");
?>

<main>
    <div class="container justify-content-center">
        <table id="tabela-edicao" class="table borda-table">
            
            <thead>
                <tr>
                    <th class="borda-top-left">ID </th>
                    <th>IFSN </th>
                    <th>Título </th>
                    <th>Área </th>
                    <th>Autores</th>
                    <th>Ano </th>
                    <th>Descrição </th>
                    <th class="borda-top-right">Ações</th>
                </tr>           
            </thead>

            <tbody class="bgVerde">

                <?php
                $resultado = getAllObras(); 
                if(!empty($resultado)) {
                    foreach ($resultado as $obraObjeto) { 
                        $indice = $obraObjeto->id;
                ?>
                        <tr id="tr-id-<?php echo $indice;?>">
                            <td id="td-id-id<?php echo $indice;?>"><?php echo $obraObjeto->id; ?></td>
                            <td id="td-id-ifsn<?php echo $indice;?>"><?php echo $obraObjeto->ifsn; ?></td>
                            <td id="td-id-titulo<?php echo $indice;?>"><?php echo $obraObjeto->titulo; ?></td>
                            <td id="td-id-area<?php echo $indice;?>"><?php echo $obraObjeto->area; ?></td>
                            <td id="td-id-autor<?php echo $indice;?>"><?php echo nomeAutoresFormatado($obraObjeto->autores);?></td>
                            <td id="td-id-ano<?php echo $indice;?>"><?php echo $obraObjeto->ano; ?></td>
                            <td id="td-id-descricao<?php echo $indice;?>"><?php echo $obraObjeto->descricao; ?></td>
                            <td>
                                <button type="button" id="button-edit-id<?php echo $indice;?>" name="editButton" class="btn btn-primary" data-bs-toggle="modal" 
                                    data-bs-target="#staticBackdrop" onclick="editarModal('<?php echo $indice;?>')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                              <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                </button>
                                <form method="post" action="../Controller/deleteObra.php" style="display: inline-block;">
                                
                                    <input type="hidden" id="remove-id<?php echo $indice;?>" name="id" value="<?php echo $indice;?>">
                                    
                                    <button type="submit" id="button-remove-id<?php echo $indice;?>" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                              <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                            </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    <?php }
                } ?>
        </tbody>
        
    </table>
</div>

<div class="d-flex justify-content-center">

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="form-edicao">
                        <div class = "form-group">
                            <label for="form-id">ID: <span class="" id="form-idd" name="id"></span></label>
                            <input type="hidden" id="form-id">
                        </div>

                        <div class = "form-group">
                            <label for="form-ifsn">IFSN</label>
                            <input type="text" class="form-control" id="form-ifsn" name="ifsn"/>
                        </div>

                        <div class="form-group">
                            <label for="form-titulo">Titulo</label>  
                            <input type="text" class="form-control" id="form-titulo" name="titulo"/>
                        </div>

                        <div class="form-group">
                            <label for="form-area">Area</label> 
                            <input type="text" class="form-control" id="form-area" name="area"/>
                        </div>

                        <div class="form-group">
                            <label for="form-autor">Autor</label>
                            <input type="text" class="form-control" id="form-autor" name="autor"/>
                        </div>

                        <div class="form-group">
                            <label for="form-ano">Ano</label>
                            <input type="number" class="form-control" id="form-ano" name="ano"/>
                        </div>

                        <div class="form-group">
                            <label for="form-descricao">Descrição</label>  
                            <textarea class="form-control" id="form-descricao" name="descricao" rows="3"></textarea> 
                        </div>

                        <div class="form-group"> 
                            <label for="exampleFormControlFile1"></label> 
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="nome_arquivo"> 
                        </div>
                                    
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="salvarEdicao()">Salvar</button>
                </div>
            </div>
        </div>
    </div>

</main>


<script>
    function editarModal(idButton){

        let formID = window.document.getElementById("form-id");
        let formIDtexto = window.document.getElementById("form-idd");
        let formIFSN = window.document.getElementById("form-ifsn");
        let formTitulo = window.document.getElementById("form-titulo");
        let formArea = window.document.getElementById("form-area");
        let formDescricao = window.document.getElementById("form-descricao");
        let formAno = window.document.getElementById("form-ano");
        let formAutor = window.document.getElementById("form-autor");
        let formNomeArquivo = window.document.getElementById("exampleFormControlFile1");

        formID.value = parseInt(window.document.getElementById("td-id-id"+ idButton).innerText);
        formIDtexto.textContent = window.document.getElementById("td-id-id"+ idButton).innerText;
        formIFSN.value = window.document.getElementById("td-id-ifsn"+ idButton).innerText;
        formTitulo.value = window.document.getElementById("td-id-titulo"+ idButton).innerText;
        formArea.value = window.document.getElementById("td-id-area"+ idButton).innerText;
        formDescricao.value = window.document.getElementById("td-id-descricao"+ idButton).innerText;
        formAno.value = parseInt(window.document.getElementById("td-id-ano"+ idButton).innerText);
        formAutor.value = window.document.getElementById("td-id-autor"+ idButton).innerText;
    }

    function deleteObra(idObra) {
        let formID = window.document.getElementById("form-id");
        <?php ?>
    }

</script>

<?php include_once("footer.html");?>