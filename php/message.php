<?php

    if(!isset($_GET["message"]) || !isset($_GET["author"])) die;

    if(!defined("chat_path")) define("chat_path", "../chat.txt");
    if(!defined("update_path")) define("update_path", "../update.txt");
    
    require("FileHandler.php");
    require("FileParser.php");

    $time = getTime();

    $fh = new FileHandler(chat_path, "", true);
    $fp = new FileParser($fh);
    $fp->addRow(["timestamp" => $time, "author" => $_GET["author"], "message" => $_GET["message"]]);

    $fh = new FileHandler(update_path, "", true);
    $fh->write($time, true);

    function getTime() {
        $tmp = explode(" ", microtime());
        $tmp[0] = substr($tmp[0], 2);
        return implode("", array_reverse($tmp));
    }