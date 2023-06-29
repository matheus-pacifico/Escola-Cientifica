<?php 
$ch = curl_init();

$url = require("get_api_url.php");
$url = $url. "obra/arquivo/upload";

$nomeOriginalArquivo = $_FILES['file']['name'];

$extensaoArquivo = pathinfo($nomeOriginalArquivo, PATHINFO_EXTENSION);

$receivedFile = $_FILES['file']['tmp_name'];

$extensoesMIME = [
    'pdf' => 'application/pdf',
    'doc' => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
];

$contentType = $extensoesMIME[strtolower($extensaoArquivo)];

curl_setopt_array($ch, [
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_HEADER => true,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => ['file' => new CurlFile($receivedFile, $contentType, $nomeOriginalArquivo)]
]);

$headers = curl_exec($ch);

$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

$location = trim(substr(serialize($headers), 105, 22));

$response = [
  'status' => $status,
  'location' => $location,
  'message' => "created"
];

if(curl_errno($ch)) {
  $response = [
    'status' => 502,
    'location' => null,
    'message' => "Erro ao enviar o arquivo"
  ];
} else if($status != 201) {
  $response = [
    'status' => $status,
    'location' => null,
    'message' => "Erro ao enviar o arquivo"
  ];
}

echo json_encode($response);

curl_close($ch);
?>
