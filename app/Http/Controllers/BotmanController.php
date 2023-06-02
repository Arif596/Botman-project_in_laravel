<?php

namespace App\Http\Controllers;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use Illuminate\Http\Request;

class BotmanController extends Controller
{
    //
    public function handle()
    {
        $botman = app('botman');
    
        $botman->hears('hi', function($botman){
            $botman->reply('Welcome to our lawyer website. How can I help you?');
        });
    
        $botman->hears('services', function($botman) {
            $services = [
                'civil matter',
                'criminal matter',
                'family matter',
                'property matter',
            ];
    
            $message = 'We have the following services: ';
            foreach ($services as $service) {
                $message .= "\n- " . ucfirst($service);
            }
    
            $botman->reply($message);
        });
    
        $botman->hears('expert lawyers in {service}', function($botman, $service) {
            $lawyers = [
                'civil matter' => ['Lawyer A', 'Lawyer B', 'Lawyer C'],
                'criminal matter' => ['Lawyer D', 'Lawyer E', 'Lawyer F'],
                'family matter' => ['Lawyer G', 'Lawyer H', 'Lawyer I'],
                'property matter' => ['Lawyer J', 'Lawyer K', 'Lawyer L'],
            ];
    
            $service = strtolower($service);
    
            if (isset($lawyers[$service])) {
                $message = 'We have the following expert lawyers in ' . ucfirst($service) . ': ';
                foreach ($lawyers[$service] as $lawyer) {
                    $message .= "\n- " . $lawyer;
                }
                $botman->reply($message);
            } else {
                $botman->reply('Sorry, we do not have expert lawyers in the service you requested.');
            }
        });
    
        $botman->fallback(function($botman) {
            $botman->reply('please , services area where evey information of lawyer available   please visit: https://your-website.com/services/" . thank you');
        });
    
        $botman->listen();
    }
    
    
    
    

    
    
}

