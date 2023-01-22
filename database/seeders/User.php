<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(3)->create();
        // if(DB::table('users')->count() == 0)
        // {
        //     $user = DB::table('users')->insert([
        //         [
        //             'id' => '1',
        //             'name' => 'Ochu Issa',
        //             'email' => 'othmaniissa2@gmail.com',
        //             'password' => Hash::make('password'),
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now(),
        //         ],
        //     ]);
        // }
    }
}
