<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Sent_message;
use GuzzleHttp\Client;


class PanelController extends Controller
{
    //
    public function dashboard(){
        return view('panel.dashboard');
    }

    public function accounts(){
        $accounts = Account::with('user_details', 'sms_sent')->get();
        return view('panel.accounts', compact('accounts'));
    }

    public function api(){
        $responses = json_decode(file_get_contents('https://api.semaphore.co/api/v4/messages?apikey=61fdeb9ce3832a133c5a201d20e5aeac&limit=1000&page=1'), true);
        foreach($responses as $response){
            $message_length = strlen($response['message']);
            if($message_length > 160){
                $cost = number_format($message_length / 160, 0);
                if($message_length % 160 >= 0){
                    $cost += 1;
                }
            }
            else {
                $cost = 1;
            }
            
            $messages = new Sent_message();
            $messages->recipient = $response['recipient'];
            $messages->message = $response['message'];
            $messages->sender_name = $response['sender_name'];
            $messages->network = $response['network'];
            $messages->status = $response['status'];
            $messages->type = $response['type'];
            $messages->message_length = $message_length;
            $messages->cost = $cost;
            $messages->sent_time = $response['created_at'];
            $messages->save();
        }

        $responses_2 = json_decode(file_get_contents('https://api.semaphore.co/api/v4/messages?apikey=61fdeb9ce3832a133c5a201d20e5aeac&limit=1000&page=2'), true);
        foreach($responses_2 as $response){
            $message_length = strlen($response['message']);
            if($message_length > 160){
                $cost = number_format($message_length / 160, 0);
                if($message_length % 160 >= 0){
                    $cost += 1;
                }
            }
            else {
                $cost = 1;
            }
            
            $messages = new Sent_message();
            $messages->recipient = $response['recipient'];
            $messages->message = $response['message'];
            $messages->sender_name = $response['sender_name'];
            $messages->network = $response['network'];
            $messages->status = $response['status'];
            $messages->type = $response['type'];
            $messages->message_length = $message_length;
            $messages->cost = $cost;
            $messages->sent_time = $response['created_at'];
            $messages->save();
        }
        $responses_3 = json_decode(file_get_contents('https://api.semaphore.co/api/v4/messages?apikey=61fdeb9ce3832a133c5a201d20e5aeac&limit=1000&page=3'), true);
        foreach($responses_3 as $response){
            $message_length = strlen($response['message']);
            if($message_length > 160){
                $cost = number_format($message_length / 160, 0);
                if($message_length % 160 >= 0){
                    $cost += 1;
                }
            }
            else {
                $cost = 1;
            }
            
            $messages = new Sent_message();
            $messages->recipient = $response['recipient'];
            $messages->message = $response['message'];
            $messages->sender_name = $response['sender_name'];
            $messages->network = $response['network'];
            $messages->status = $response['status'];
            $messages->type = $response['type'];
            $messages->message_length = $message_length;
            $messages->cost = $cost;
            $messages->sent_time = $response['created_at'];
            $messages->save();
        }
        dd($responses);
       
    }

    public function settings(){
        return view('panel.settings');
    }
    public function sms_logs(){
        return view('panel.sms_logs');
    }

    public function account_view(){
        return view('panel.accounts-view');
    }
}
