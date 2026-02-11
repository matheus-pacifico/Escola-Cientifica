<?php include_once("head.html");
include_once("../controller/getObras.php");
?>

<H1 class="d-flex justify-content-center margemT">Gerenciar trabalhos</H1>

<main id="gerenciar">

    <div class="container d-flex justify-content-center margem-bottom-20">
        <div class="bgBranco borda-table">
            <table class="table sem-margem-bottom">
                <thead>
                    <tr id="thead-tr">
                        <th class="borda-top-left">IFSN</th>
                        <th>Título</th>
                        <th>Área</th>
                        <th>Autores</th>
                        <th>Ano</th>
                        <th>Descrição</th>
                        <th class="borda-top-right" style="min-width: 105px;">Ações</th>
                    </tr>           
                </thead>

                <tbody>

                    <?php
                    $resultado = getAllObras(); 
                    if(!empty($resultado)) {
                        foreach ($resultado as $obraObjeto) { 
                            $indice = $obraObjeto->id;
                            ?>

                            <tr id="tr-id-<?php echo $indice;?>">
                                <span style="display: none;" id="span-id-id<?php echo $indice;?>" value="<?php echo $indice; ?>" data_id="<?php echo $indice; ?>"></span>
                                <span style="display: none;" id="span-id-nomeArquivo<?php echo $indice;?>" value="<?php echo $obraObjeto->nomeArquivo; ?>" data_nomeA="<?php echo $obraObjeto->nomeArquivo; ?>"></span>
                                <span style="display: none;" id="span-id-caminhoArquivo<?php echo $indice;?>" value="<?php echo $obraObjeto->caminhoArquivo; ?>" data_caminhoA="<?php echo $obraObjeto->caminhoArquivo; ?>"></span>
                                <td id="td-id-ifsn<?php echo $indice;?>"><?php echo $obraObjeto->ifsn; ?></td>
                                <td id="td-id-titulo<?php echo $indice;?>"><?php echo $obraObjeto->titulo; ?></td>
                                <td id="td-id-area<?php echo $indice;?>"><?php echo $obraObjeto->area; ?></td>
                                <td id="td-id-autor<?php echo $indice;?>" data_num_autores="<?php echo numeroAutores($obraObjeto->autores);?>">
                                    <?php echo nomeAutoresFormatado($obraObjeto->autores);
                                    if(numeroAutores($obraObjeto->autores) != 1) {
                                        $i = 0;
                                        foreach ($obraObjeto->autores as $autor) {?>
                                            <span style="display: none;" id="<?php echo $indice . 'span-id-autor' . $i;?>" data_autor_id="<?php echo $autor->id;?>" name="<?php echo $autor->nome;?>"></span>
                                            <?php $i++;
                                        }
                                    }
                                    ?>
                                </td>

                                <td id="td-id-ano<?php echo $indice;?>"><?php echo $obraObjeto->ano; ?></td>
                                <td id="td-id-descricao<?php echo $indice;?>"><?php echo $obraObjeto->descricao; ?></td>
                                <td colspan="2">
                                    <button type="button" style="display: inline-block;" id="button-edit-id<?php echo $indice;?>" name="editButton" class="btn btn-primary" data-bs-toggle="modal" 
                                        data-bs-target="#staticBackdrop" onclick="editarModal('<?php echo $indice;?>')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                          <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                      </svg>
                                  </button>
                                  <form method="post" action="../controller/deleteObra.php" style="display: inline-block;">

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
</div>

<div class="d-flex justify-content-center">

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex justify-content-center" id="staticBackdropLabel">Editar trabalho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="form-edicao" method="POST" action="../controller/putObra.php">
                        <div class = "form-group">
                            <input type="hidden" id="form-id" name="id">
                        </div>

                        <div class = "form-group">
                            <label for="form-ifsn">IFSN</label>
                            <input type="text" class="form-control" id="form-ifsn" name="ifsn">
                        </div>

                        <div class="form-group">
                            <label for="form-titulo">Título</label>  
                            <input type="text" class="form-control" id="form-titulo" name="titulo">
                        </div>

                        <div class="form-group">
                            <label for="form-area">Área</label> 
                            <input type="text" class="form-control" id="form-area" name="area">
                        </div>

                        <div class="form-group">
                            <label for="form-ano">Ano</label>
                            <input type="number" class="form-control" id="form-ano" name="ano">
                        </div>

                        <div class="form-group" name="form-autores">
                            <label for="form-autor">Autor(es)</label>
                            <input type="text" class="form-control" id="form-autor" name="autor">
                            <input id="form-autor-id" type="hidden" name="autor_id">
                        </div>

                        <div class="form-group">
                            <label for="form-descricao">Descrição</label>  
                            <textarea class="form-control" id="form-descricao" name="descricao" rows="3"></textarea> 
                        </div>                   

                        <div class="mb-2 row">  
                            <span class="" style="max-width: 180px;">
                                <label for="input-arquivo" class="botao-file" style="padding: 4px 5px; margin-top: 12px;">Escolher arquivo</label>  
                                <input type="file" id="input-arquivo" name="arquivo" accept=".pdf, .doc, .docx" style="display: none;"/>
                            </span> 
                            <span class="col-7 col-md-8 col-sm-8 col-lg-8 col-xl-8">
                                <div id="status-do-envio" style="margin-top: 12px; font-size: 1.45em"></div>
                            </span>
                        </div>

                        <div class="mb-2 row">
                            <input id="nameFile" type="hidden" name="nome_arquivo">
                            <input id="pathFile" type="hidden" name="caminho_arquivo">
                        </div>
                        <button id="button-atualizar" type="submit" hidden="true"></button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" onclick="salvarEdicao()">Salvar</button>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    function editarModal(idButton){
        let formID = window.document.getElementById("form-id");
        let formIFSN = window.document.getElementById("form-ifsn");
        let formTitulo = window.document.getElementById("form-titulo");
        let formArea = window.document.getElementById("form-area");
        let formDescricao = window.document.getElementById("form-descricao");
        let formAno = window.document.getElementById("form-ano");
        let formNomeArquivo = window.document.getElementById("nameFile");
        let formCaminhoArquivo = window.document.getElementById("pathFile");

        formID.value = parseInt(window.document.getElementById("span-id-id"+ idButton).getAttribute('data_id'));
        formIFSN.value = window.document.getElementById("td-id-ifsn"+ idButton).innerText;
        formTitulo.value = window.document.getElementById("td-id-titulo"+ idButton).innerText;
        formArea.value = window.document.getElementById("td-id-area"+ idButton).innerText;
        formDescricao.value = window.document.getElementById("td-id-descricao"+ idButton).innerText;
        formAno.value = parseInt(window.document.getElementById("td-id-ano"+ idButton).innerText);
        formNomeArquivo.value = window.document.getElementById("span-id-nomeArquivo" + idButton).getAttribute('data_nomeA');
        formCaminhoArquivo.value = window.document.getElementById("span-id-caminhoArquivo" + idButton).getAttribute('data_caminhoA');
        let quantidadeAutores = parseInt(window.document.getElementById("td-id-autor"+ idButton).getAttribute('data_num_autores'));
        
        let $divFormAutores = $('[name="form-autores"]');
        $divFormAutores.find('.input-autor-added').remove();

        if(quantidadeAutores === 1) {
            let formAutor = window.document.getElementById("form-autor");
            formAutor.value = window.document.getElementById("td-id-autor"+ idButton).innerText;
            let formAutorId = window.document.getElementById("form-autor-id");
            formAutorId.value = window.document.getElementById(idButton + "span-id-autor0");
        } else {

            let formAutor = window.document.getElementById("form-autor");
            formAutor.value = window.document.getElementById(idButton + "span-id-autor0").getAttribute('name');
            let formAutorId = window.document.getElementById("form-autor-id");
            formAutorId.value = window.document.getElementById(idButton + "span-id-autor0");

            let $primeiroInput = $divFormAutores.find('input:first');

            for(let i = 1; i < quantidadeAutores; i++) {

                let $inputNome = $('<input type="text" style="margin-top: 6px;" class="form-control input-autor-added" id="form-autor' + i + '" name="autor' + i + '" value="' + document.getElementById(idButton + "span-id-autor" + i).getAttribute('name') + '">');
                $primeiroInput.after($inputNome);
                let $inputId = $('<input id="form-autor-id' + i + '" class="input-autor-added" type="hidden" name="autor_id' + i + '"' +
                    ' value ="' + document.getElementById(idButton + "span-id-autor" + i).getAttribute('data_autor_id') + '">');
                $primeiroInput.after($inputId);
            }
        }

        showCurrentFileName(formNomeArquivo.value);
    }

    function showCurrentFileName(nomeArquivo) {
        const nomeFile = document.getElementById('status-do-envio');
        nomeFile.style.color = '#32A041';
        nomeFile.style.fontSize = '1.21em';
        nomeFile.style.marginTop = '7px';
        nomeFile.innerHTML = nomeArquivo + 
        '<span style="margin-left: 2px;"> ' + 
            '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" ' +
            'width="22" height="22" viewBox="0 -960 960 960"> ' + 
                '<path d="M382-231.847 144.616-469.231l60.769-60.768L382-353.384l374.615-374.615 60.769 60.768L382-231.847Z"/> ' +
            '</svg> ' +
        '</span>';
    }

    function salvarEdicao() {
        let botaoSalvar = document.getElementById('button-atualizar');
        botaoSalvar.click();
    }

</script>

<script src="../controller/uploadArquivo.js"></script>

<?php include_once("footer.html");?>