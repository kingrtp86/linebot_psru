<?php

$messages = [];
$messages['replyToken'] = 'token';
$messages['messages'][0] = getFormatTextMessage('test');

$encodeJson = json_encode($messages);

echo $encodeJson;

function getFormatTextMessage($text)
{
    $datas = [];
    $datas['type'] = 'text';
    $datas['text'] = $text;

    return $datas;
}