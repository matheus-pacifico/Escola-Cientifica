$(document).ready(function() {
	const fileInput = document.getElementById('input-arquivo');
	const statusDoEnvio = document.getElementById('status-do-envio');
	let fileName = '';

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
		xhr.open('POST', "../Controller/uploadFile.php", true);

		addUploadingMessage();

		xhr.onreadystatechange = function() {
			if (xhr.readyState === XMLHttpRequest.DONE) {
				stopToggle();
				if (xhr.status === 200) {
					let resposta = JSON.parse(xhr.responseText);
					if(resposta.status == 201) {
						const uri = resposta.location;
						setInputsFileInformation(uri);
						showSuccessfulUploadMessage();
					} else {
						showFailUploadMessage();
					}
				} else {
					showFailUploadMessage();
				}
			}
		};

		xhr.send(formData);
	}

	function setInputsFileInformation(uri) {
		nomeArquivo = document.getElementById('nameFile');
		caminhoArquivo = document.getElementById('pathFile');
		nomeArquivo.value = fileName;
		caminhoArquivo.value = uri;
		fileInput.value = '';
	}

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

	function stopToggle() {
		clearInterval(intervalId);
		stopRequested = true;
	}

	function addUploadingMessage() {
		statusDoEnvio.style.color = '#32A041';
		statusDoEnvio.textContent = 'Enviando';
		startToggle();
	}

	function showSuccessfulUploadMessage() {
		statusDoEnvio.style.fontSize = '1.21em';
		statusDoEnvio.style.marginTop = '7px';
		statusDoEnvio.innerHTML = fileName + 
		'<span style="margin-left: 2px;"> ' + 
			'<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" ' +
			'width="22" height="22" viewBox="0 -960 960 960"> ' + 
				'<path d="M382-231.847 144.616-469.231l60.769-60.768L382-353.384l374.615-374.615 60.769 60.768L382-231.847Z"/> ' +
			'</svg> ' +
		'</span>';
	}

	function showFailUploadMessage() {
		statusDoEnvio.style.fontSize = '1.35em';
		statusDoEnvio.style.color = '#DC3545';
		statusDoEnvio.textContent = 'Erro ao enviar o arquivo.';
	}

});