<?php

    if(!isset($_GET["message"]) || !isset($_GET["author"])) die;

    if(!defined("chat_path")) define("chat_path", "../chat.txt");
    if(!defined("update_path")) define("update_path", "../update.txt");
    
    require("FileHandler.php");
    require("FileParser.php");

    $fh = new FileHandler(chat_path, "", true);
    $fp = new FileParser($fh);
    $fp->addRow(["timestamp" => time(), "author" => $_GET["author"], "message" => $_GET["message"]]);

    $time = time();
    $fh = new FileHandler(update_path, "", true);
    $fh->write($time, true);