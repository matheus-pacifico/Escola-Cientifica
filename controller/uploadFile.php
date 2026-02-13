<?php 
$ch = curl_init();

$url = require("get_api_url.php");
$url = $url. "arquivo/upload";

$nomeOriginalArquivo = $_FILES['file']['name'];

$receivedFile = $_FILES['file']['tmp_name'];

$contentType = 'application/pdf';

curl_setopt_array($ch, [
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_HEADER => true,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => ['file' => new CurlFile($receivedFile, $contentType, $nomeOriginalArquivo)]
]);

$responsea = curl_exec($ch);

$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($responsea, 0, $headerSize);
$body = substr($responsea, $headerSize);

$location = null;
if (preg_match('/Location:\s*(.+)/i', $headers, $matches)) {
    $location = trim($matches[1]);
}

if(curl_errno($ch)) {
  $response = [
    'status' => 502,
    'location' => null,
    'message' => "Erro ao enviar o arquivo"
  ];
curl_close($ch);
} else if($status != 201) {
  $response = [
    'status' => $status,
    'location' => null,
    'message' => "Erro ao enviar o arquivo"
  ];
} else {
  $response = [
  'status' => $status,
  'location' => $location,
  'message' => "created"
];
}
echo json_encode($response);
?>
