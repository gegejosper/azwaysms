<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Account;
use DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('accounts')->truncate();
        DB::table('users')->truncate();
        DB::table('personal_access_tokens')->truncate();
        $user = User::create([
            'name' => 'Gegejosper',
            'email' => 'gegejosper@gmail.com',
            'password' => bcrypt('password')
        ]);
        for($client = 0; $client <= 10; $client++){
            $faker = \Faker\Factory::create();
            $user = User::create([
                'name' => $faker->firstName().' '.$faker->lastName(),
                'email' => $faker->email(),
                'password' => bcrypt('password')
            ]);
            
            $token = $user->createToken('azwaysmstoken')->plainTextToken;
            $account = new Account();
            $account->user_id = $user->id;
            $account->token = $token;
            $account->sender_name = 'default';
            $account->load = 200;
            $account->status = 'active';
            $account->save();
        }
    }
}
