<?php
$datas = file_get_contents('php://input');
    
$deCode = json_decode($datas,true);

// write log RAW json 
file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);

$replyToken = $deCode['events'][0]['replyToken'];
$botText = $deCode['events'][0]['message']['text'];


$LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
$LINEDatas['token'] = "bPEky6S93kubYWNK8pI9CkShjChJsWyN+tXDkU2vgtC6WraQeDGgiyGf+JP5ZUQoV0LgoLJ91dtZ6aHa//zRJjshOBkU19IpuTfFj/oMcSPFeBUnq4PMGujlsJgH7CZ6o1YDENnEja0GY7dDl40wYQdB04t89/1O/w1cDnyilFU=";