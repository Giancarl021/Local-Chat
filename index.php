<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>O Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
    <!-- PRESET BY Giancarl021 -->
    <script src="js/script.js"></script>
    <script>
        const SERVER_IP = <?php echo "'" . $_SERVER["SERVER_NAME"] . "'" ?> || null;
    </script>
</head>

<body>
    <header class="flex-center digit-text" data-text=">>> O Chat <<<" data-milliseconds="80"></header>
    <section id="chat-container">
        <div id="chat-panel"></div>
        <div id="message-container">
            <input id="message-field" onkeydown="event.key === 'Enter' && sendMessage()"/>
            <button type="button" id="send-message" onclick="sendMessage()">></button>
        </div>
    </section>
    <section id="setup-panel">
        <div class="setup-container">
            <input type="text" placeholder="Nickname" id="nickname"/>
        </div>
    </section>
</body>

</html>