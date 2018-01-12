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
        \App\User::create([
            'name' => 'Test User1',
            'username' => 'test1',
            'email' => 'user1@user.com',
            'password' => Hash::make('123123'),
            'usertype' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        \App\User::create([
            'name' => 'Test User2',
            'username' => 'test2',
            'email' => 'user2@user.com',
            'password' => Hash::make('123123'),
            'usertype' => '2',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
