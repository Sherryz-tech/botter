<?php
$text=$_GET['text'];
    if($text){
         if ($text == "/start") {
            $reply = "Welcome to the Bot $chat_id you a sign up";
        }elseif ($text == "/help") {
            $reply = "Help info";
        }elseif ($text == "Price") {
        }elseif ($text == "Wallet to pay") {
        }elseif ($text == "Exchenge") {
            $answer = sendMessage([ 'chat_id' => $chat_id, 'text' => 'How match?', 'reply_markup'=> $telegram->ForceReply(['force_reply' => true, 'selective'   => false])]);
			sendMessage([ 'chat_id' => $chat_id, 'text' => "exchange ".$answer." BTC"]);
		}elseif ($text == "Register") {
        }elseif ($text == "Balance") {
        }
    }else{
    	sendMessage([ 'chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение." ]);
    }