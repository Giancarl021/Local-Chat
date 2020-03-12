<?php
    require("FileHandler.php");
    require("FileParser.php");

    if(!defined("chat_path")) define("chat_path", "../chat.txt");
    
    $fh = new FileHandler(chat_path, "", true);
    $fp = new FileParser($fh);

    $raw = $fp->loadData();

    $messages = [];

    foreach($raw as $message) {
        array_push($messages, ["timestamp" => $message[0], "author" => $message[1], "message" => $message[2]]);
    }

    echo json_encode($messages);
