<?php
namespace App\Conversation;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Middleware\ApiAi;
use BotMan\BotMan\Interfaces\Middleware\Received;
use Cake\ORM\TableRegistry;
use BotMan\BotMan\Interfaces\Middleware\Captured;

class ExampleConversation extends Conversation
{   
    
    public function askName(){
        $chats = TableRegistry::get('ChatBots');
        $res = $chats->find()->select(['id','name'])->where(['ip_address' => $_SERVER['REMOTE_ADDR']])->first();
        $chatResult = $res->toArray();
        if($chatResult['name'] == ''){
            $question = Question::create("I would certainly help you in providing the best possible information. Could you please provide me your name?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_name')
            ->addButtons([
                Button::create('Yes')->value('yes'),
                Button::create('No')->value('no'),
            ]);
           
            return $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    if ($answer->getValue() === 'yes') {
                        $this->say('Yes');
                        $this->ask('What is your name?', function(Answer $answer) {                         
                        $this->firstname = $answer->getText();

                        $chats = TableRegistry::get('ChatBots');
                        $res = $chats->find()->select(['id','name'])->where(['ip_address' => $_SERVER['REMOTE_ADDR']])->first();
                        $chatResult = $res->toArray();
                       /* $chat = $chats->get($chatResult['id']); 
                        $chat->name = $this->firstname;
                        $chats->save($chat);   */
                        $this->say('Nice to meet you, '.$this->firstname);
                        $this->askOptions(); 
                        });
                    } else {
                        $this->say('No');
                        $this->say('Okay,No Worries!!');
                        $this->askOptions();
                    }
                }else{
                    if(preg_match('/^y+e+s+$|^n+o+$/',trim(strtolower($answer->getText())))) {
                        $this->askOptions();
                    }else{
                        $this->say('Sorry, I didnt understand these commands');
                        $this->askName();
                    }
                }
            });
        }
        else{
            $this->say('Welcome Back, '.$chatResult['name']);
            $this->askOptions();
        }
    }

    public function askOptions(){
        $question2 = Question::create("Which Option would you like to have?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_options')
            ->addButtons([
                Button::create('FAQs')->value('faq'),
                Button::create('Schedule an appointment')->value('appointment'),
                Button::create('Job postings and opportunities')->value('job'),
            ]);
        $this->ask($question2, function(Answer $answer){
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'faq') {
                    $this->userOption = 'FAQs';
                    $this->say($this->userOption);
                    $this->askFaqQuestions();
                } 
            }else{
                if(preg_match("/^[faq]*$/",trim(strtolower($answer->getText())))) {
                    $this->askFaqQuestions();
                }else{
                    $this->say('Sorry, I didnt understand these commands');
                    $this->askOptions();
                }
            }
        });
    }

    public function askFaqQuestions(){
        $question3 = Question::create("Welcome to CompanyCo’s careers page. What brought you here to check us out? You can select from one of the topics below, or just let me know what you’re looking for.")
        ->fallback('Unable to ask question')
        ->callbackId('ask_faq_questions')
        ->addButtons([
            Button::create('Graduate Hiring')->value('graduate'),
            Button::create('Professional Hiring')->value('professional'),
            Button::create('Support Staff')->value('support'),
            Button::create('Internships')->value('internship'),
            Button::create('Other')->value('other'),
        ]);
        $this->ask($question3, function(Answer $answer){
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'professional') {
                    $this->userOption = 'Professional Hiring';
                    $this->say($this->userOption);
                    $this->askFaqProfessionals();
                }
                if ($answer->getValue() === 'other') {
                    $this->userOption = 'How Can we help you?';
                    $this->say($this->userOption);
                    $this->askFaqOtherHiring();
                }
            }
        });
    }

    public function askFaqProfessionals(){
        $question4 = Question::create("Great! I can help answer your questions about professional hiring. Are you looking for answers about any of these? ")
        ->fallback('Unable to ask question')
        ->callbackId('ask_faq_professionals')
        ->addButtons([
            Button::create('Current Oppurtunites')->value('oppurtunities'),
            Button::create('Life at CompanyCo')->value('companyco'),
            Button::create('Hiring Process')->value('hiring'),
            Button::create('Other')->value('other'),
        ]);
        $this->ask($question4, function(Answer $answer){
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'hiring') {
                    $this->userOption = 'Hiring Process';
                    $this->say($this->userOption);
                    $this->askFaqProfessionalHirings();
                }
            }
        });
    }

    public function askFaqProfessionalHirings(){
        $question5 = Question::create("Got it. I can tell you about:  ")
        ->fallback('Unable to ask question')
        ->callbackId('ask_faq_professional_hirings')
        ->addButtons([
            Button::create('The Application Process')->value('application'),
            Button::create('Interviews')->value('interview'),
            Button::create('New Hire Support')->value('support'),
        ]);
        $this->ask($question5, function(Answer $answer){
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'interview') {
                    $this->userOption = 'Interviews';
                    $this->say($this->userOption);
                    $this->askFaqProfessionalHiringInterview();
                }
            }
        });
    }

    public function askFaqProfessionalHiringInterview(){
        $this->say('Okay! Our interview process begins with a short interview in one of our offices.');
        $this->say('You may be invited back to a CompanyCo office for three longer “call back” interviews where you will have an opportunity to meet with a variety of CompanyCo leaders.');
        $this->say(' We hope that the process will give you an opportunity to learn more about CompanyCo, and for us to get to know you.');
        $this->say('Want to know more about interviewing at CompanyCo? Feel free to ask a question. ');
    }

    public function askFaqOtherHiring(){
        $this->bot->hears('other_hiring', function ($bot) {
            pr($bot);die;
            //$extras = $this->bot->getMessage()->getExtras();
           // pr($extras);die;
            //$bot->reply($extras['apiReply']);
        })->middleware($dialogflow);
    }

    public function run()
    {
        $this->askName();
    }
}
?>
