<?php
$token = '8368397544:AAFQcS9a7SiHJ8wDzxWMPqs75CnaLL6aHtI';
$website = 'https://api.telegram.org/bot'.$token;
$input = file_get_contents('php://input');
$update = json_decode($input, TRUE);
$chatId = $update['message']['chat']['id'];
$message = $update['message']['text'];
switch($message)
{
    case '/start':
		$response = 'ddd';
        sendMessage($chatId,$response);
        break;
    case 'como me ira':
        $response ='bien po';
        sendMessage($chatId,$response);
        break;
    default:
        $response = 'no entendi jaja';
        sendMessage($chatID,$response);
}
?>
