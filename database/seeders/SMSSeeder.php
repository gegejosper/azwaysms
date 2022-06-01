<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\Smslog;

class SMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $accounts = Account::where('status', 'active')->get();
        //dd()
        foreach($accounts as $account){
            for($count = 0; $count < 10; $count++){
                $token = $account->token;
                $number = '09090900290202';
                $message = 'Hello, this is AZWAy SMS Notification';
                $data = array(
                    'number' => $number,
                    'message' => $message,
                    'sender_name' => $account->sender_name
                );
                $client = curl_init('http://127.0.0.1:8000/api/send_sms');
                $headers = array(
                "Accept: application/json",
                "Authorization: Bearer $token",
                );
                curl_setopt($client, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($client, CURLOPT_POST, true);
                curl_setopt($client, CURLOPT_POSTFIELDS, $data);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                $response  = json_decode($response);
                //dd($response);
                if($response->message == 'success'){
                    $smslog = new Smslog();
                    $smslog->client_id = $account->user_id;
                    $smslog->number = $number;
                    $smslog->char_number = '160';
                    $smslog->message = $message;
                    $smslog->load_credit = 1;
                    $smslog->status = 'sent';
                    $smslog->save();
                    $account = Account::find($account->id);
                    $load = $account->load;
                    $balance = $load - 1;
                    $account->load = $balance;
                    $account->save();
                }
                curl_close($client);
            }
            
        }
        
        //var_dump($response);
    }
}
