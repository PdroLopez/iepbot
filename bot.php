<?php
$token = "8371377874:AAHOPqXAbcUUgsCNX5m30dhIjTYP0v8iT98";
$apiURL = "https://api.telegram.org/bot$token";
$logFile = __DIR__."/log.txt";

// Leer y loggear entrada
$input = file_get_contents("php://input");
file_put_contents($logFile, date("Y-m-d H:i:s")." - ".$input."\n", FILE_APPEND);

$update = json_decode($input, true);

if (isset($update['message'])) {
    $chatId = $update['message']['chat']['id'];
    $message = $update['message']['text'];

    switch($message){
        case "/start":
            $text = "Hola 👋, soy tu bot!";
            break;
        case "como me ira":
            $text = "Bien po 😎";
            break;
        default:
            $text = "No entendí jaja 😅";
            break;
    }

    // Enviar mensaje con cURL y timeout
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiURL."/sendMessage");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        "chat_id"=>$chatId,
        "text"=>$text
    ]));
    curl_setopt($ch, CURLOPT_TIMEOUT, 2); // Timeout máximo 2s
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

// Responder HTTP 200 inmediatamente
http_response_code(200);
exit();
?>
