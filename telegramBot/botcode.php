<?php

$fecha = date('Y-m-d H:i:s');
$botlog = "botlog.log";
file_put_contents($botlog, "-------------------------------------------------- \n", FILE_APPEND);
file_put_contents($botlog, "- Execució iniciada en dia: ".$fecha."\n", FILE_APPEND);

$TOKEN = "1788218139:AAG8X3sS42RP8iSCcqqByW6RfVSeTuxmoa0";
$URL = "https://api.telegram.org/bot$TOKEN";
file_put_contents($botlog, "- Token emprat: ".$TOKEN."\n", FILE_APPEND);
file_put_contents($botlog, "- URL emprada: ".$URL."\n", FILE_APPEND);

function sendMessage($chat_id, $text)
{
    global $botlog;
    file_put_contents($botlog, "- Enviant missatge: \"".$text."\" a ".$chat_id."\n", FILE_APPEND);
    global $URL;
    return file_get_contents($URL . '/sendMessage?chat_id=' . $chat_id . '&text=' . $text . '&parse_mode=HTML');
}

$request = file_get_contents("php://input");

file_put_contents($botlog, "- Contingut rebut: ".$request."\n", FILE_APPEND);

$request = json_decode($request);

$message = "Hola " . $request->message->from->first_name . ", benvingut al BOT.";
sendMessage($request->message->chat->id, $message);

$message = "Em consta que m'has escrit el següent: ";
sendMessage($request->message->chat->id, $message);

sendMessage($request->message->chat->id, $request->message->text);
file_put_contents($botlog, "--------------------------------------------------- \n", FILE_APPEND);

