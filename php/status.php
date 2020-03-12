<?php
    header("Cache-Control: no-cache");
    
    require("FileHandler.php");
    if(!defined("update_path")) define("update_path", "../update.txt");

    $fh = new FileHandler(update_path, "", true);

    echo $fh->read();