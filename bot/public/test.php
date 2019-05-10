<?php

http_response_code(200);

$datas = file_get_contents('php://input');
    
$deCode = json_decode($datas,true);

file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);

$replyToken = $deCode['events'][0]['replyToken'];
$botText = $deCode['events'][0]['message']['text'];

// $messages = [];
// $messages['replyToken'] = $replyToken;
// $messages['messages'][0] = getFormatTextMessage($LINE_text);

// $encodeJson = json_encode($messages);

$LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
$LINEDatas['token'] = "bPEky6S93kubYWNK8pI9CkShjChJsWyN+tXDkU2vgtC6WraQeDGgiyGf+JP5ZUQoV0LgoLJ91dtZ6aHa//zRJjshOBkU19IpuTfFj/oMcSPFeBUnq4PMGujlsJgH7CZ6o1YDENnEja0GY7dDl40wYQdB04t89/1O/w1cDnyilFU=";


if ($botText == 'ทดสอบ') {
    $text = 'ทดสอบ Format Text 2';
    sendFormatTextMessage($LINEDatas, $replyToken, $text);
}

function sendFormatTextMessage($LINEDatas, $replyToken, $text)
{

    $str = '{
        "replyToken":"'.$replyToken.'",
        "messages":
        [
            {
                "type":"text",
                "text":"'.$text.'"
            }
        ]
    }';

    sentMessage($str,$LINEDatas);
}

echo "this bot running";

function sentMessage($encodeJson,$datas)
{
    $datasReturn = [];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $datas['url'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $encodeJson,
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer " . $datas['token'],
            "cache-control: no-cache",
            "content-type: application/json; charset=UTF-8",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        $datasReturn['result'] = 'E';
        $datasReturn['message'] = $err;
    } else {
        if($response == "{}") {
        $datasReturn['result'] = 'S';
        $datasReturn['message'] = 'Success';
        } else {
            $datasReturn['result'] = 'E';
            $datasReturn['message'] = $response;
        }
    }

    return $datasReturn;
}