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
            [
                'username' => 'test',
                'mail' => 'test@gmail.com',
                'password' => 'test1234',
            ]
        ]);
        //
    }
}
