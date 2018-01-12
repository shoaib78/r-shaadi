<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vader = DB::table('admin')->insert([
            'username'   => 'admin',
            'email'      => 'admin@admin.com',
            'password'   => Hash::make('123123'),
            'name' => 'Wedding Addmin',
            'isAdmin'=>1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        $vader = DB::table('users')->insert([
            'name' => 'Test User1',
            'username' => 'test1',
            'email' => 'user1@user.com',
            'password' => Hash::make('123123'),
            'usertype' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        $vader = DB::table('users')->insert([
            'name' => 'Test User22',
            'username' => 'test22',
            'email' => 'test2@user.com',
            'password' => Hash::make('123123'),
            'usertype' => '2',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
