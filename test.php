<?php

require_once("func/function_agora.php");
$agora = new Agora;
//print_r($_POST);
if (isset($_POST['cmd'])&&$_POST['cmd']=="balance") {
    $response = json_decode($agora->send_cmd("", "wallet-balance"));
    $balance = $response->data->total->balance;
//    echo $balance;
}

if (isset($_POST['cmd'])&&$_POST['cmd']=="price") {
    $response = json_decode($agora->send_cmd("", "sell-bitcoins-online/USD/cryptocurrency"));
    $price=$response->data->ad_list[0]->data->temp_price;
//    echo $price;
}

if (isset($_POST['cmd'])&&$_POST['cmd']=="pay") {
    $response = json_decode($agora->send_cmd("", "wallet-addr"));
//    print_r($response);
    $pay=$response->data->address;
//    echo $pay;
}

if (isset($_POST['cmd'])&&$_POST['cmd']=="wallet") {
    $response = json_decode($agora->send_cmd("", "wallet"));
    print_r($response);
    $wallet=$response->data->received_transactions_30d;
    echo $wallet;
}
    
//var_dump($agora->send_cmd("", "dashboard"));
//$response = json_decode($agora->send_cmd("", "sell-bitcoins-online/USD/cryptocurrency"));
//echo $response->data->ad_list[0]->data->temp_price;
?>

<form name="balance" method="post">
<input type="submit" value="balance">
<input type="hidden" name="cmd" value="balance">
</form>
<span><?php echo @$balance ?: null;?></span>

<form name="price" method="post">
<input type="submit" value="Price">
<input type="hidden" name="cmd" value="price">
</form>
<span><?php echo @$price ?: null;?></span>

<form name="pay" method="post">
<input type="submit" value="Pay">
<input type="hidden" name="cmd" value="pay">
</form>
<span><?php echo @$pay ?: null;?></span>

<form name="wallet" method="post">
<input type="submit" value="Transaction">
<input type="hidden" name="cmd" value="wallet">
</form>
<span><?php echo @$wallet ?: null;?></span>
