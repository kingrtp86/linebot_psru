<?php
$datas = file_get_contents('php://input');
    
$deCode = json_decode($datas,true);

// write log RAW json 
file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);

$replyToken = $deCode['events'][0]['replyToken'];
$botText = $deCode['events'][0]['message']['text'];


$LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
$LINEDatas['token'] = "";
