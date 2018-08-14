<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BotMan Widget Demo</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        body {
            font-family: "Varela Round", sans-serif;
            margin: 0;
            padding: 0;
            background: radial-gradient(#57bfc7, #45a6b3);
        }

        .container {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .content {
            text-align: center;
        }

        .logo {
            margin-right: 40px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="logo">
            
        </div>
        <h1>BotMan Widget Demo</h1>
        <p>
            This is a demonstration of the BotMan chat widget. It uses the BotMan commands from <a href="https://github.com/mpociot/php-uk-conference-2018/blob/master/routes/botman.php" target="_blank">here</a>.
        </p>
        <p>
            You can also <a href="#" onclick="botmanChatWidget.say('Hello');return false;">say things</a> programatically.
            Or if you're more of a sneaky-type, you can also <a href="#" onclick="botmanChatWidget.whisper('give me videos')">whisper</a> ðŸ¤«.
        </p>
        <p>It is also <a href="https://github.com/botman/web-widget/blob/master/src/widget/configuration.js" target="_blank">highly configurable</a>.</p>
    </div>
</div>

<script>
    var botmanWidget = {
        chatServer: 'chatConversation',
        introMessage:'Hello, Welcome to Pooja chatbot !!',
        frameEndpoint: 'ChatBots/chat',
        title: 'ChatBot',
        placeholderText: 'Ask Me Something',
        //aboutText: 'Powered By Eluert Mukja',
        //aboutLink: 'mhdevelopment.gr',
    };
</script>
<script id="botmanWidget" src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
</body>
</html>