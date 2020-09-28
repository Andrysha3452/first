<?php
$confirmationToken = '55566f0c';
$secretKey = 'ebanashka';    
// Функция отправляющая сообщения
function vk_msg_send($peer_id, $text){
    
    $request_params = array(
      'message' => $text,
      'attachment' => $attachment,
      'peer_id' => $peer_id,
      'access_token' => 'de69dabf296d0339209ab0aa1cccd7851f78a752dcb75a947656786dd10ce863da0270bb683c23a71b825',
      'v' => '5.124'
    );
    
    $get_params = http_build_query($request_params); 
    file_get_contents('https://api.vk.com/method/messages.send?' . $get_params);
}
$data = json_decode(file_get_contents('php://input')); // Получаем данные с ВК
if(strcmp($data->secret, $secretKey) !== 0 && strcmp($data->type, 'confirmation') !== 0) {
    return;
}
switch ($data->type) {  
    case 'confirmation': 
        echo $confirmationToken; // Если ВК запрашивает подтверждение, то выводим код подтверждения 
    break;  
        
    case 'message_new':
        // Если событие нового сообщения, то получаем его текст
        $message_text = $data->object->text;
        $peer_id = $data->object->peer_id;
        
        $message_text = mb_strtolower($message_text, 'UTF-8'); // Переводим текст к нижнему регистру
        
        // Если сообщение содержит подстроку привет, отправляем сообщение
        if(strpos($message_text, "привет") !== false){
            vk_msg_send($peer_id, "Привет");
        }
        
        echo 'ok'; // Обязательно уведомляем сервер, что сообщение получено, текстом ok
    break;
}
?>
