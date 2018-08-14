<?php
namespace App\Controller;

use App\Controller\AppController;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Cache\RedisCache;
use Cake\Event\Event;
use BotMan\BotMan\Middleware\ApiAi;
use App\Conversation\ExampleConversation;


class ChatBotsController extends AppController
{

    public function beforeFilter(Event $event)
    {
     $actions = [
        'chatConversation',
     ];

        if (in_array($this->request->params['action'], $actions)) {
        // for csrf
        $this->eventManager()->off($this->Csrf);

        // for security component
        $this->Security->config('unlockedActions', $actions);
        }
    }

    public function chat(){
        $this->viewBuilder()->layout(false);
    } 
    
    public function chatConversation()
    {
        $config = [];
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
        $botman = BotManFactory::create($config, new RedisCache('127.0.0.1', 6379));
        $dialogflow = ApiAi::create('f8079f51d9db4f9c8d097d853b51a821')->listenForAction();
        $botman->middleware->received($dialogflow);
        
        $botman->hears('input.welcome', function ($bot) {
            $value = $this->ChatBots->find()->select(['id'])->where(['ip_address' => $_SERVER['REMOTE_ADDR']])->first();
            if(empty($value)){
                $chatBot = $this->ChatBots->newEntity();
                $chatBot->ip_address = $_SERVER['REMOTE_ADDR'];
                $chatBot->created = date('Y-m-d H:i:s');
                $this->ChatBots->save($chatBot);
            }
            $bot->startConversation(new ExampleConversation());
        })->middleware($dialogflow);

        $botman->hears('avoid_words', function ($bot) {
            $extras = $bot->getMessage()->getExtras();
            $bot->reply($extras['apiReply']);
            $bot->startConversation(new ExampleConversation());
        })->middleware($dialogflow);

        $botman->hears('other_hiring', function ($bot) {
            $extras = $bot->getMessage()->getExtras();
            pr($extras);die;
            //$bot->reply($extras['apiReply']);
        })->middleware($dialogflow);

        $botman->fallback(function ($bot){
            $bot->reply('Sorry, I didnt understand these commands');
        });
        $botman->listen();
        die;
    }

    public function demo(){
        // echo"1";
    } 

}