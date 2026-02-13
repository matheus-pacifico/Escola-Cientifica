<?php 
include_once("head.html");
include_once("../controller/getObras.php");
$API_URL = require_once("../controller/get_api_url.php");
?>

<main id="gerenciar">

    <h1 class="d-flex justify-content-center margemT">Gerenciar trabalhos</h1>
    <div class="container d-flex justify-content-center margem-bottom-20">
        <div class="bgBranco borda-table" style="overflow-x: auto">
            <table class="table sem-margem-bottom">
                <thead>
                    <tr id="thead-tr">
                        <th class="borda-top-left">IFSN</th>
                        <th>Título</th>
                        <th class="borda-top-right" style="min-width: 90px;">Ações</th>
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
                                <span style="display: none;" id="span-id-nomeArquivo<?php echo $indice;?>" value="<?php echo scape_html_tags($obraObjeto->arquivo->nomeArquivo, true); ?>" data_nomeA="<?php echo scape_html_tags($obraObjeto->arquivo->nomeArquivo, true); ?>"></span>
                                <span style="display: none;" id="span-id-idArquivo<?php echo $indice;?>" value="<?php echo scape_html_tags($obraObjeto->arquivo->idArquivo);?>" data_idA="<?php echo scape_html_tags($obraObjeto->arquivo->idArquivo);?>"></span>
                                <td id="td-id-ifsn<?php echo $indice;?>"><?php echo scape_html_tags($obraObjeto->ifsn, true); ?></td>
                                <td id="td-id-titulo<?php echo $indice;?>"><?php echo scape_html_tags($obraObjeto->titulo, true); ?></td>
                                <td style="display: none;" id="td-id-area<?php echo $indice;?>"><?php echo scape_html_tags($obraObjeto->area, true); ?></td>
                                <td style="display: none;" id="td-id-autor<?php echo $indice;?>" data_num_autores="<?php echo numeroAutores($obraObjeto->autores);?>"><?php echo scape_html_tags(nomeAutoresFormatado($obraObjeto->autores), true);?><?php if(numeroAutores($obraObjeto->autores) != 1) {$i = 0;foreach ($obraObjeto->autores as $autor) {?><span style="display: none;" id="<?php echo $indice . 'span-id-autor' . $i;?>" data_autor_id="<?php echo $autor->id;?>" name="<?php echo scape_html_tags($autor->nome, true);?>"></span><?php $i++;
                                        }
                                    }
                                    ?></td>

                                <td style="display: none;" id="td-id-ano<?php echo $indice;?>"><?php echo scape_html_tags($obraObjeto->ano, true); ?></td>
                                <td style="display: none;" id="td-id-descricao<?php echo $indice;?>" data_descricao="<?php echo scape_html_tags($obraObjeto->descricao, true);?>"><?php echo descricaoLimitada(scape_html_tags($obraObjeto->descricao)); ?></td>
                                <td colspan="2">
                                    <button type="button" style="display: inline-block;padding: 4px 8px;" id="button-edit-id<?php echo $indice;?>" name="editButton" class="btn btn-primary" title="Editar" data-bs-toggle="modal" 
                                        data-bs-target="#staticBackdrop" onclick="editarModal('<?php echo $indice;?>')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                          <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                      </svg>
                                  </button>
                                  <form method="post" action="../controller/deleteObra" style="display: inline-block;">

                                    <input type="hidden" id="remove-id<?php echo $indice;?>" name="id" value="<?php echo $indice;?>">

                                    <button type="submit" style="padding: 4px 8px;" id="button-remove-id<?php echo $indice;?>" class="btn btn-danger" title="Excluir">
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

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="overflow-x:auto">
            <div id="modal-gerenciar" class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex justify-content-center" id="staticBackdropLabel">Editar trabalho</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="form-edicao" method="POST" action="../controller/putObra">
                            <div class = "form-group">
                                <input type="hidden" id="form-id" name="id">
                            </div>

                            <div class="form-group mt-2">
                                <label for="form-titulo">Título</label>  
                                <input type="text" class="form-control" id="form-titulo" name="titulo" required>
                            </div>

                            <div class = "form-group">
                                <label for="form-ifsn">IFSN</label>
                                <input type="text" class="form-control" id="form-ifsn" name="ifsn" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="form-area">Área</label> 
                                <input type="text" class="form-control" id="form-area" name="area" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="form-ano">Ano</label>
                                <input type="text" class="form-control" id="form-ano" name="ano" autocomplete="off" maxlength="4" inputmode="numeric" pattern="\d{1,4}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,4)" required>
                            </div>

                            <div class="form-group mt-2" name="form-autores">
                                <label for="form-autor">Autor(es)</label>
                                <input type="text" class="form-control" id="form-autor" name="autor">
                                <input id="form-autor-id" type="hidden" name="autor_id">
                            </div>

                            <div class="form-group mt-2 mb-2">
                                <label for="form-descricao">Descrição</label>  
                                <textarea class="form-control" id="form-descricao" name="descricao" rows="4" required></textarea> 
                            </div>                   

                            <div class="mb-2">
                                <span class="" style="max-width: 180px; margin-right:4px;user-select: none">
                                    <label for="input-arquivo" class="botao-file" style="padding: 4px 5px; margin-top: 12px;">Escolher arquivo</label>
                                    <input type="file" id="input-arquivo" name="arquivo" accept=".pdf" style="display: none;"/>
                                </span>
                                <div id="status-do-envio" style="margin-top: 12px; display: inline-block" title="Baixar arquivo"></div>
                               
                            </div>
                            <div class="mb-2 row">
                                <input id="nameFile" type="hidden" name="nome_arquivo" required />
                            </div>

                            <div class="mb-2 row">
                                <input type="text" id="infoFile" style="display: none;" name="info_arquivo" />
                            </div>

                            <button id="button-atualizar" type="submit" hidden="true"></button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button id="cancelar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" onclick="salvarEdicao()">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="../controller/uploadArquivo.js"></script>

<script>
    let modalOpenedAt = null;
    let fileSentAt = Date.now();
    function editarModal(idButton) {
        modalOpenedAt = Date.now();
        let formID = window.document.getElementById("form-id");
        let formIFSN = window.document.getElementById("form-ifsn");
        let formTitulo = window.document.getElementById("form-titulo");
        let formArea = window.document.getElementById("form-area");
        let formDescricao = window.document.getElementById("form-descricao");
        let formAno = window.document.getElementById("form-ano");
        let formNomeArquivo = window.document.getElementById("nameFile");
        let fileInput = document.getElementById('input-arquivo');
        let btnClose = window.document.querySelector("button.btn-close");
        let btnCancel = window.document.querySelector("button#cancelar");

        formID.value = parseInt(window.document.getElementById("span-id-id"+ idButton).getAttribute('data_id'));
        formIFSN.value = window.document.getElementById("td-id-ifsn"+ idButton).innerText;
        formTitulo.value = window.document.getElementById("td-id-titulo"+ idButton).innerText;
        formArea.value = window.document.getElementById("td-id-area"+ idButton).innerText;
        formDescricao.value = window.document.getElementById("td-id-descricao"+ idButton).getAttribute('data_descricao');
        formAno.value = parseInt(window.document.getElementById("td-id-ano"+ idButton).innerText);
        formNomeArquivo.value = window.document.getElementById("span-id-nomeArquivo" + idButton).getAttribute('data_nomeA');
        fileInput.value = '';
        let quantidadeAutores = parseInt(window.document.getElementById("td-id-autor"+ idButton).getAttribute('data_num_autores'));
        
        let $divFormAutores = $('[name="form-autores"]');
        $divFormAutores.find('.input-autor-added').remove();
        let $segundoInput = $divFormAutores.find('input:eq(1)');

        if(quantidadeAutores === 1) {
            let formAutor = window.document.getElementById("form-autor");
            formAutor.value = window.document.getElementById("td-id-autor"+ idButton).innerText;
            let formAutorId = window.document.getElementById("form-autor-id");
            formAutorId.value = window.document.getElementById(idButton + "span-id-autor0");

            let $inputNome = $('<input type="text" style="margin-top: 6px;" class="form-control input-autor-added" id="form-autor1" name="autor1" value="">');
            $segundoInput.after($inputNome);
            let $inputId = $('<input id="form-autor-id1" class="input-autor-added" type="hidden" name="autor_id1"> value=""');
            $inputNome.after($inputId);
        } else {
            let formAutor = window.document.getElementById("form-autor");
            formAutor.value = window.document.getElementById(idButton + "span-id-autor0").getAttribute('name');
            let formAutorId = window.document.getElementById("form-autor-id");
            formAutorId.value = window.document.getElementById(idButton + "span-id-autor0").getAttribute('data_autor_id');

            for(let i = 1; i < quantidadeAutores; i++) {
                let $inputNome = $('<input type="text" style="margin-top: 6px;" class="form-control input-autor-added" id="form-autor' + i + '" name="autor' + i + '" value="' + document.getElementById(idButton + "span-id-autor" + i).getAttribute('name') + '">');
                $segundoInput.after($inputNome);
                let $inputId = $('<input id="form-autor-id' + i + '" class="input-autor-added" type="hidden" name="autor_id' + i + '"' +
                    ' value ="' + document.getElementById(idButton + "span-id-autor" + i).getAttribute('data_autor_id') + '">');
                $inputNome.after($inputId);
            }
        }

        showCurrentFileName(formNomeArquivo.value);
        
        const statusDoEnvio = document.getElementById('status-do-envio');
        statusDoEnvio.classList.add('file');
        statusDoEnvio.title="Baixar arquivo";
        const idArquivo = window.document.getElementById("span-id-idArquivo" + idButton).getAttribute('data_idA');
        const downloadListener = function() {
        	downloadCurrentFile(statusDoEnvio, idArquivo, formIFSN.value);
    	};
        statusDoEnvio.removeEventListener('click', downloadListener);
        statusDoEnvio.addEventListener('click', downloadListener);
        
        const uploadingFileListener = function() {
            statusDoEnvio.classList.remove("file");
            statusDoEnvio.classList.add("uploading");
            fileSentAt = Date.now();
        	statusDoEnvio.removeEventListener('click', downloadListener);
            statusDoEnvio.title="Enviando arquivo";
        };
        
        const uploadSuccessListener = function(event) {
            if (fileSentAt < modalOpenedAt) {
                return;
            }
            showCurrentFileName(event.detail.file);
            setInputsFileInformation(event.detail.uri);
            statusDoEnvio.classList.remove("uploading");
            statusDoEnvio.title="Arquivo enviado";
        };
        
        const uploadFailedListener = function(event) {
            if (fileSentAt < modalOpenedAt) {
                return;
            }
            showFailUploadMessage();
            statusDoEnvio.classList.remove("uploading");
            statusDoEnvio.title="";
        };
        
        document.addEventListener('uploadingFile', uploadingFileListener);
        document.addEventListener('uploadSuccess', uploadSuccessListener);
        document.addEventListener('uploadFailed', uploadFailedListener);
        
        btnClose.addEventListener('click', () => {
            document.removeEventListener('uploadingFile', uploadingFileListener);
            document.removeEventListener('uploadSuccess', uploadSuccessListener);
            document.removeEventListener('uploadFailed', uploadFailedListener);
            statusDoEnvio.classList.remove("uploading");
            stopToggle();
        });
        
        btnCancel.addEventListener('click', () => {
            document.removeEventListener('uploadingFile', uploadingFileListener);
            document.removeEventListener('uploadSuccess', uploadSuccessListener);
            document.removeEventListener('uploadFailed', uploadFailedListener);
            statusDoEnvio.classList.remove("uploading");
            stopToggle();
        });
    }

    function showCurrentFileName(nomeArquivo) {
        const nomeFile = document.getElementById('status-do-envio');
        nomeFile.style.color = '#32A041';
        nomeFile.style.fontSize = '1em';
        nomeFile.style.marginTop = '7px';
        nomeFile.innerHTML = nomeArquivo + 
        '<span style="margin-left: 4px;">' + 
            '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" ' +
            'width="20" height="20" viewBox="0 -960 960 960" style="margin-top:-3px">' + 
                '<path d="M382-231.847 144.616-469.231l60.769-60.768L382-353.384l374.615-374.615 60.769 60.768L382-231.847Z"/>' +
            '</svg>' +
        '</span>';
    }

    function salvarEdicao() {
        let botaoSalvar = document.getElementById('button-atualizar');
        botaoSalvar.click();
    }
    
    function downloadCurrentFile(satusDoEnvio, idArquivo, ifsn) {
       if (!satusDoEnvio.innerText.toLowerCase().endsWith('.pdf')) {
           return;
       }
       const download_url = <?php echo json_encode($API_URL); ?> + "arquivo/download/"+ idArquivo;
       const a = document.createElement('a');
       a.href=download_url +"?forcedownload=1&n=" + ifsn;
       a.click();
    }
</script>


<?php include_once("footer.html");?>
