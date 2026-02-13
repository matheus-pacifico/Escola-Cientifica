let stopToggle;
let showSuccessfulUploadMessage;
let showFailUploadMessage;
let setInputsFileInformation;

$(document).ready(function() {
	const fileInput = document.getElementById('input-arquivo');
	const statusDoEnvio = document.getElementById('status-do-envio');
	let fileName = '';
	let token = null;
    
	fileInput.addEventListener('change', (event) => {
		const file = event.target.files[0];
		if (file) {
			if(file.size > 10 * 1024 * 1024) {
				alert('O tamanho máximo do arquivo é de 10 MB. Por favor, selecione um arquivo menor.');
				fileInput.value = '';
			} else {
				uploadFile(file);
			}	
		}
	});

	function uploadFile(file) {
		const formData = new FormData();
		formData.append('file', file);
		fileName = file.name;

		const xhr = new XMLHttpRequest();
		xhr.open('POST', "../controller/uploadFile.php", true);

		addUploadingMessage();

		xhr.onreadystatechange = function() {
			if (xhr.readyState === XMLHttpRequest.DONE) {
				stopToggle();
				if (xhr.status !== 200) {
                    dispatchFailedUploadEvent();
                    return;
                }
                let resposta = JSON.parse(xhr.responseText);
                if(resposta.status != 201) {
                    dispatchFailedUploadEvent();
                    return;
                } 
                token = resposta.location;
                dispatchSuccessUploadEvent();
			}
		};

		dispatchUploadingFileEvent();
		xhr.send(formData);
	}

	setInputsFileInformation = function(uri) {
		infoArquivo = document.getElementById('infoFile');
		infoArquivo.value = uri;
		fileInput.value = '';
	};

	let stopRequested = false;
	let intervalId = 0;
	let dots = '';

	function startToggle() {
	  intervalId = setInterval(toggleText, 1000);
	}

	function toggleText() {
		if (dots.length < 3) {
			dots += '.';
		} else {
			dots = '';
		}
		statusDoEnvio.innerHTML = 'Enviando' + dots;
		if (stopRequested) {
			clearInterval(intervalId);
		}
	}

	stopToggle = function() {
		clearInterval(intervalId);
		stopRequested = true;
	};

	function addUploadingMessage() {
		statusDoEnvio.style.fontSize = '1.2em';
		statusDoEnvio.style.marginTop = '7px';
		statusDoEnvio.style.color = '#32A041';
		statusDoEnvio.textContent = 'Enviando';
		stopRequested = false;
		startToggle();
	}

	showSuccessfulUploadMessage = function() {
		statusDoEnvio.style.fontSize = '1em';
		statusDoEnvio.style.marginTop = '9px';
		statusDoEnvio.innerHTML = fileName + 
		'<span style="margin-left: 4px;">' + 
			'<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" ' +
			'width="22" height="22" viewBox="0 -960 960 960" style="margin-top:-3px">' + 
				'<path d="M382-231.847 144.616-469.231l60.769-60.768L382-353.384l374.615-374.615 60.769 60.768L382-231.847Z"/>' +
			'</svg> ' +
		'</span>';
	}

	showFailUploadMessage = function(resposta) {
		statusDoEnvio.style.fontSize = '1.2em';
		statusDoEnvio.style.color = '#DC3545';
		statusDoEnvio.textContent = 'Erro ao enviar arquivo';
	};

    function dispatchSuccessUploadEvent() {
        const event = new CustomEvent('uploadSuccess', {
            detail: {
                message: "Upload successful",
                file: fileName,
                uri: token
            }
        });
        document.dispatchEvent(event);
    }
    
    function dispatchUploadingFileEvent() {
        const event = new CustomEvent('uploadingFile', {
            detail: {
                message: "Uploading"
            }
        });
        document.dispatchEvent(event);        
    }
    
    function dispatchFailedUploadEvent() {
        const event = new CustomEvent('uploadFailed', {
            detail: {
                message: "Upload failed"
            }
        });
        document.dispatchEvent(event);
    }
    
});