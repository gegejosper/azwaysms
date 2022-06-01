<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Smslog;

class SmsController extends Controller
{
    //
    public function send_sms(Request $req){
        // $api = '61fdeb9ce3832a133c5a201d20e5aeac';
        // $ch = curl_init();
        // $parameters = array(
        //     'apikey' => $api, //Your API KEY
        //     'number' => $req->number,
        //     'message' => $req->message,
        //     'sendername' => 'AZWAYPH'
        // );
        // curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        // curl_setopt( $ch, CURLOPT_POST, 1 );

        // //Send the parameters set above with the request
        // curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // // Receive response from server
        // curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        // $output = curl_exec( $ch );
        // curl_close ($ch);
        
        //return response()->json($output);
        $response = [
            'message' => 'success',
            'result' => $req
        ];
        return response ($response, 201);
    }
    public function execute_sms(){
        $token = '2|78112c7e617b8acb740dd3a3bd1d20aa25e96a7db3b3d72626df47d1ffe36c5b';
        $number = '09090900290202';
        $message = 'Hello, this is AZWAy SMS Notification';
        $data = array(
            'number' => $number,
            'message' => $message,
            'sender_name' => 'gege'
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
        // $accounts = Account::with('token_detail')->where('status', 'active')->get();
        // //dd()
        // foreach($accounts as $account){
        //     for($count = 0; $count < 10; $count++){
        //         $token = '2|78112c7e617b8acb740dd3a3bd1d20aa25e96a7db3b3d72626df47d1ffe36c5b';
        //         $number = '09090900290202';
        //         $message = 'Hello, this is AZWAy SMS Notification';
        //         $data = array(
        //             'number' => $number,
        //             'message' => $message,
        //             'sender_name' => $account->sender_name
        //         );
        //         $client = curl_init('http://127.0.0.1:8000/api/send_sms');
        //         $headers = array(
        //         "Accept: application/json",
        //         "Authorization: Bearer $token",
        //         );
        //         curl_setopt($client, CURLOPT_HTTPHEADER, $headers);
        //         curl_setopt($client, CURLOPT_POST, true);
        //         curl_setopt($client, CURLOPT_POSTFIELDS, $data);
        //         curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        //         $response = curl_exec($client);
        //         if($response->message == 'success'){
        //             $smslog = new Smslog();
        //             $smslog->client_id = $account->token_detail->tokenable_id;
        //             $smslog->number = $number;
        //             $smslog->char_number = '160';
        //             $smslog->message = $message;
        //             $smslog->load_credit = 1;
        //             $smslog->status = 'sent';
        //             $smslog->save();

        //             $account = Account::find($account->token_detail->tokenable_id);
        //             $load = $account->load;
        //             $balance = $load - 1;
        //             $account->load = $balance;
        //             $account->save();
        //         }
        //         curl_close($client);
        //     }
        // }
        echo "success";
    }
}
