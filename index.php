<?php
/**
 * revcom_bot
 *
 * @author - Александр Штокман
 */
header('Content-Type: text/html; charset=utf-8');
// подрубаем API
require_once("vendor/autoload.php");

use Telegram\Bot\Api;

$telegram = new Api('5100938458:AAH71g8P2ROvg21YwKK6VLJ_02FPuk9yILY');

$response = $telegram->getMe();

$botId = $response->getId();
$firstName = $response->getFirstName();
$username = $response->getUsername();


var_dump($response);