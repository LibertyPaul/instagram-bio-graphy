<?php

define('API_KEY', '586229409:AAGDtdt9wt8-TBBEXgsQWKNiQtTY1VfX4RY');

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
function sendmessage($chat_id, $text){
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>$text,
 'parse_mode'=>"MarkDown"
 ]);
 } 
 function objectToArrays($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map("objectToArrays", $object);
    }
//-//////
$update = json_decode(file_get_contents('php://input'));
$message = $update->message; 
$chat_id = $message->chat->id;
$text = $message->text;
//---------------//
if($text == '/start'){
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"welcome to user instagram biography
for example : perspolis24_official",
 'parse_mode'=>"MarkDown"
 ]);
}

elseif($text){
$instagramapi = json_decode(file_get_contents("https://www.instapi.io/u/$text"));
    $insta = objectToArrays($instagramapi);
    $a1 = $insta ['graphql']['user']['biography'];
    $a2 = $insta ['graphql']["user"]["followed_by"]["count"];
    $a3 = $insta ['graphql']["user"]["follows"]["count"];
    $a4 = $insta ['graphql']["user"]["media"]["count"];
    $a5 = $insta ['graphql']["user"]["external_url"];
    $a6 = $insta ['graphql']["user"]["username"];
    $a7 = $insta ['graphql']["user"]["profile_pic_url_hd"];
  
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>users bio :
$a1
‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
📍following => ($a2)

📍follower => ($a3)

📍posts=> ($a4)
‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾",
 'parse_mode'=>"MarkDown"
 ]);
}

?>
