<?php
$msg=$_GET["message"];
$token=$_GET["token"];
echo $msg;
echo $token;
$strAccessToken = "dzaOAQEbS4W3KQFaoq2IbC8Z6rxrvk46MkI6tgcmhFRy9amJTG48myOZdg8OuKsex4aKxDgevUajHk9PgtXLR1GTjlFav5brcEKP8bV/o+YqkSeVylPHY+UtfzzNrZO4OT6ZGZSfa3cFvpNMosmuRQdB04t89/1O/w1cDnyilFU=";
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($strAccessToken);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '6a5f9c0a5f70c92c3d64186f9a14ec16']);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($msg);
$response = $bot->replyMessage($token, $textMessageBuilder);

// echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>
