<?php
// Token y URL del API
$token = "8371377874:AAHOPqXAbcUUgsCNX5m30dhIjTYP0v8iT98";
$apiURL = "https://api.telegram.org/bot$token";

// Archivo de log
$logFile = __DIR__ . "/log.txt";

// Leer la entrada de Telegram
$input = file_get_contents("php://input");
file_put_contents($logFile, date("Y-m-d H:i:s") . "-" . $input . "\n", FILE_APPEND);

// Decodificar JSON
$update = json_decode($input, true);

if (isset($update['message'])) {
    $chatId = $update['message']['chat']['id'];
    $message = $update['message']['text'];

    // Respuestas básicas
    switch($message) {
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

    // Enviar respuesta a Telegram
    file_get_contents($apiURL."/sendMessage?chat_id=".$chatId."&text=".urlencode($text));
}

// Responder 200 OK siempre
http_response_code(200);
exit();
?>
