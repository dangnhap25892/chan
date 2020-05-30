<?php
$access_token = 'EAANubfLJEDEBAHht1v8ooEKqSMnL2rFFHZAOTVjtv7oBEfzqUAUIIEjfmpTjdYRR5piPDSPNk5OIdybCJzytSEzWFpzLcfJoV1trA01nnwFdoiqlE2hxjrqTnJEKgUzVFGJyx2isvZA5X3VoQZAFV0VfLEZAZA3cXFNFftru7MgZDZD';
$verify_token = 'b30e56607d11f75f666d869d1398ccaa';
$hub_verify_token = null;
if(isset($_REQUEST['hub_mode']) && $_REQUEST['hub_mode']=='subscribe'){
  $challenge = $_REQUEST['hub_challenge'];
  $hub_verify_token = $_REQUEST['hub_verify_token'];
  if($hub_verify_token===$verify_token){
    header('HTTP/1.1 200 OK');
    echo $challenge;
    die;
  }
}
$input = json_decode(file_get_contents('php://input'),true);
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = isset($input['entry'][0]['messaging'][0]['message']['text'])? $input['entry'][0]['messaging'][0]['message']['text']:'';
if($message){
  //you can change your logic here to reply what you want
  if($message=='hi'){ //if user sends hi we will reply like this
    $message_to_reply = 'Hello !!! How can I help you ?';
  }else{
    $message_to_reply = "This is the message to send back to the user";
  }
  $url = "https://graph.facebook.com/v2.6/me/messages?access_token=".$access_token;
  $jsonData = '{
          "recipient:{
            "id":"'.$sendere.'"
          },
          "message":{
            "text":"'.$message_to_reply.'"
          }
        }';
  $ch = curl_init($url);
  curl_setopt($ch,CURLOPT_POST,1);
  curl_setopt($ch,CURLOPT_POSTFIELDS,$jsonData);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);
}
 