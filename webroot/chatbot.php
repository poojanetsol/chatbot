<?php     
//include 'OnboardConversation.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Cache\RedisCache;

$config = [];
DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
$botman = BotManFactory::create($config, new RedisCache('127.0.0.1', 6379));
//$bot = new BotMan();
/*$botman->hears('.*(Hi|Hello).*', function($bot) {
    $bot->startConversation(new OnboardingConversation);
});*/
$botman->hears('hello', function (BotMan $bot) {
    $bot->reply('Hello yourself.');
});

// Start listening
$botman->listen();
?>
