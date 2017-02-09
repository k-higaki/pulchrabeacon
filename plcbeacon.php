<?php
$request = file_get_contents("php://input");
$json = json_decode($request);
$content = $json->result[0]->content;

$header = array(
    'Content-Type: application/json; charser=UTF-8',
    'X-Line-ChannelID: 【1499841386】',  // Channel ID
    'X-Line-ChannelSecret: 【2fc981e2e4b2a8584da33b9d9e705eb0】',  // ChannelID Secret
);
$post = array(
    'to' => array($content->from),
    'toChannel' => 1383378250,  // Fixed value.
    'eventType' => '138311608800106203',  // Fixed value.
    'content' => array(
        'contentType' => 1,
        'toType' => 1,
    ),
);

// ボットが返答する内容。ここでは送られた内容を復唱するだけ
$post['content']['text'] = $content->text.' ですね';

$post = json_encode($post);

$ch = curl_init("https://trialbot-api.line.me/v1/events");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
