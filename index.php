<?php
	
    include('vendor/autoload.php'); //Подключаем библиотеку
	require_once("func/function_agora.php");
    use Telegram\Bot\Api; 

	$agora = new Agora;
    $telegram = new Api('---xxxx---'); //Устанавливаем токен, полученный у BotFather
    $result = $telegram -> getWebhookUpdates(); //Передаем в переменную $result полную информацию о сообщении пользователя
    
	//print_r($result);
    $text = $result["message"]["text"]; //Текст сообщения
    $chat_id = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя
    $name = $result["message"]["chat"]["first_name"]; //Юзернейм пользователя
    $keyboard = [["Balance"], ["Wallet to pay"], ["Exchenge"]]; //Клавиатура

    if($text){
         if ($text == "/start") {
            $reply = "Welcome to the Bot $name you a sign up";
            $reply_markup = $telegram->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false ]);
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup ]);
        }elseif ($text == "/help") {
            $reply = "Help info";
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => 'Help']);
        }elseif ($text == "/help") {
            $reply = "Help info";
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => 'Help']);
        }elseif ($text == "Price") {
			$response = json_decode($agora->send_cmd("", "sell-bitcoins-online/USD/cryptocurrency"));
			$reply=$response->data->ad_list[0]->data->temp_price;
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply ]);
        }elseif ($text == "Wallet to pay") {
			$response = json_decode($agora->send_cmd("", "wallet-addr"));
			$reply=$response->data->address;			
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply]);
        }elseif ($text == "Exchenge") {
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => 'How match?', 'reply_markup'=> $telegram->ForceReply(['force_reply' => true, 'selective'   => false])]);
		}elseif ($text == "Register") {
            $url = "https://68.media.tumblr.com/6d830b4f2c455f9cb6cd4ebe5011d2b8/tumblr_oj49kevkUz1v4bb1no1_500.jpg";
            $telegram->sendPhoto([ 'chat_id' => $chat_id, 'photo' => $url, 'caption' => "Описание." ]);
        }elseif ($text == "Balance") {
            $response = json_decode($agora->send_cmd("", "wallet-balance"));
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $response->data->total->balance ]);
        }
    }else{
    	$telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение." ]);
    }
	
?>
