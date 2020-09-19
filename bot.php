<?php

include "vk_api.php"; 


const VK_KEY = "7c2fd9da50000344e740f0af5b3df46c2c7ab88a3da669c22341019053530007103d574d3cc0184766587";  // Токен сообщества
const ACCESS_KEY = "39ae8162";  // Тот самый ключ из сообщества 
const VERSION = "5.81"; // Версия API VK


$vk = new vk_api(VK_KEY, VERSION); 
$data = json_decode(file_get_contents('php://input')); 

if ($data->type == 'confirmation') { 
    exit(ACCESS_KEY); 
}
$vk->sendOK(); 
// ====== Наши переменные ============
$id = $data->object->from_id; // Узнаем ID пользователя, кто написал нам
$message = $data->object->text; // Само сообщение от пользователя
// ====== *************** ============

if ($data->type == 'message_new') {

    if ($message == '!бот') {

            $vk->sendMessage($id, "Привет :-)");
			
        }


	}
	