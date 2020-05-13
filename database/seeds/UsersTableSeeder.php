<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'System Admin',
            'email' => 'admin@dev.com',
            'password' => bcrypt('admin123'),
            'created_at' =>  date("Y-m-d H:i:s")
        ]);

        $user = \App\User::where('email','admin@dev.com')->first();
        $user->assignRole('administrator');

        DB::table('users')->insert([
            'name' => 'Vendor 01',
            'email' => 'vendor1@dev.com',
            'password' => bcrypt('123456Aa'),
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        $user = \App\User::where('email','vendor1@dev.com')->first();
        $user->assignRole('vendor');

        DB::table('users')->insert([
            'name' => 'Customer 01',
            'email' => 'customer1@dev.com',
            'password' => bcrypt('123456Aa'),
            'created_at' =>  date("Y-m-d H:i:s")
        ]);

        $user = \App\User::where('email','customer1@dev.com')->first();
        $user->assignRole('customer');


        DB::table('users')->insert([
            'name' => 'Do Quan',
            'email' => 'quandq@gmail.com',
            'password' => bcrypt('quangquan'),
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        $user = \App\User::where('email','quandq@gmail.com')->first();
        $user->assignRole('administrator');
    }
}
