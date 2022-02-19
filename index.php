<?php
    include('vendor/autoload.php'); //Подключаем библиотеку
	require_once("func/function_agora.php");
    use Telegram\Bot\Api; 

	$agora = new Agora;
    $telegram = new Api('5100938458:AAH71g8P2ROvg21YwKK6VLJ_02FPuk9yILY'); //Устанавливаем токен, полученный у BotFather
    $result = $telegram -> getWebhookUpdates(); //Передаем в переменную $result полную информацию о сообщении пользователя
    
    $text = $result["message"]["text"]; //Текст сообщения
    $chat_id = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя
    $name = $result["message"]["from"]["username"]; //Юзернейм пользователя
    $keyboard = [["Balance"], ["Wallet to pay"]]; //Клавиатура

    if($text){
         if ($text == "/start") {
            $reply = "Welcome to the Bot ".$name." you a sign up";
            $reply_markup = $telegram->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false ]);
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup ]);
        }elseif ($text == "/help") {
            $reply = "Help info";
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply ]);
        }elseif ($text == "Price") {
			$response = json_decode($agora->send_cmd("", "sell-bitcoins-online/USD/cryptocurrency"));
			$reply=$response->data->ad_list[0]->data->temp_price;
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply ]);
        }elseif ($text == "Wallet to pay") {
			$response = json_decode($agora->send_cmd("", "wallet-addr"));
			$reply=$response->data->address;			
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply." amount? eg amount 0.5" ]);
        }elseif (substr($text,0,6) == "amount") {
			$a=trim(strstr($text, " "));
			$a=(int)$a;
			$response = json_decode($agora->send_cmd("", "wallet-addr"));
			$reply=$response->data->address;
			$amount=$a-rand(0,1);
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply." amount to pay_".$amount." ".var_dump($amount)]);
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