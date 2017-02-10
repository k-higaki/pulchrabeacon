<?php // callback.php
define("LINE_MESSAGING_API_CHANNEL_SECRET", '2fc981e2e4b2a8584da33b9d9e705eb0');
define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'jdODSUiXGHGh8Qr5EqIo9bMx7D9mkU0SxgzgGAANTexfsgxMJzgPMKSqHtaUOSd/EYg+2yz6kXT1tO2tl4v6v0vz++JmB7GL8OZQV+wDH6G+k5F05qsFSYvw2CdnGCdOz6pxxBeo6xumwqr+ehLx9AdB04t89/1O/w1cDnyilFU=');
require __DIR__."/../vendor/autoload.php";
$bot = new \LINE\LINEBot(
    new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN),
    ['channelSecret' => LINE_MESSAGING_API_CHANNEL_SECRET]
);
$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$body = file_get_contents("php://input");
$events = $bot->parseEventRequest($body, $signature);
foreach ($events as $event) {
    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
        $reply_token = $event->getReplyToken();
        $text = $event->getText();
        $bot->replyText($reply_token, $text);
    }
}
echo "OK";