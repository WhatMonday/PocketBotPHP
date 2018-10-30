<?php
    $accessToken = "dzaOAQEbS4W3KQFaoq2IbC8Z6rxrvk46MkI6tgcmhFRy9amJTG48myOZdg8OuKsex4aKxDgevUajHk9PgtXLR1GTjlFav5brcEKP8bV/o+YqkSeVylPHY+UtfzzNrZO4OT6ZGZSfa3cFvpNMosmuRQdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    $arrayHeader = array();
        $arrayHeader[] = "Content-Type: application/json";
        $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    $message = $arrayJson['events'][0]['message']['text']; //receive message from LINE
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "text";
        if($message == "สวัสดี"){
            $topic = "node1"
            //pubMqtt($topic,$message)
            $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";}
        else if($message == "ลาก่อน"){
            //pubMqtt("phphook",$message)
            $arrayPostData['messages'][0]['text'] = "โชคดีนะ";}
        else{$arrayPostData['messages'][0]['text'] = "ไม่เข้าใจคำสั่ง";}
        replyMsg($arrayHeader,$arrayPostData);
        
function pubMqtt($topic,$msg){
    $appid= "PocketBot/"; //enter your appid
    $key = "LdRKpKsOIWwinGl"; //enter your key
    $secret = "xrmzXXM5Rrek6nZIqmBGWYLtl"; //enter your secret
    $Topic = "$topic"; 
      put("https://api.netpie.io/microgear/".$appid.$Topic."?retain&auth=".$key.":".$secret,$msg);
  }
function put($url,$tmsg){ 
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $tmsg);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

    $response = curl_exec($ch);
    curl_close($ch);
    echo $response . "\r\n";
    return $response;
}
function replyMsg($arrayHeader,$arrayPostData){
    $strUrl = "https://api.line.me/v2/bot/message/reply";
    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
        curl_close ($ch);
    }

   exit;
?>
