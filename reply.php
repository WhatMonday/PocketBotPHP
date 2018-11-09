<?php
$msg=$_GET["message"];
$token=$_GET["token"];
$accessToken = "dzaOAQEbS4W3KQFaoq2IbC8Z6rxrvk46MkI6tgcmhFRy9amJTG48myOZdg8OuKsex4aKxDgevUajHk9PgtXLR1GTjlFav5brcEKP8bV/o+YqkSeVylPHY+UtfzzNrZO4OT6ZGZSfa3cFvpNMosmuRQdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    $arrayHeader = array();
        $arrayHeader[] = "Content-Type: application/json";
        $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    $arrayPostData['replyToken'] = $token;
    $arrayPostData['messages'][0]['type'] = "text";
    $arrayPostData['messages'][0]['text'] = ConvertMessage($msg);    
replyMsg($arrayHeader,$arrayPostData);
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
function ConvertMessage($msg){
 $device = array("ไฟหน้าบ้าน","D1","D2","D3","D4","D5","D6","D7","D8");
   $s = explode(",", $msg);
   $result=$device[(int)$s[0]];
    if ($s[2] == "check"){
         if ($s[1] == "on"){
             $result .= " ถูกเปิดอยู่";
        }else if($s[1] == "off"){
             $result .= " ถูกปิดอยู่";
        }
    }else{ 
        if ($s[2] == "on"){
             $result .= " ถูกเปิดแล้ว";
        }else if($s[2] == "off"){
             $result .= " ถูกปิดแล้ว";
        }
    }
    return $result;
}
?>
