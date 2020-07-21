<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        User::create([
            'name' => 'Rodrigo Evaristo',
            'email' => 'rodrigo@saudali.com.br',
            'password' => bcrypt('123456'),
        ]);
        */

        factory(user::class,10)->create();
    }
}
