<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\member;
use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create Default Branch
        Branch::create([
            'id' => 1,
            'branch_name' => 'Ministry of Health',
            'status' => 1,
        ]);

        //Create first user
        member::create([
            'id' => 1,
            'f_name' => 'Othman',
            'l_name' => 'Issa',
            'email' => 'ochu@gmail.com',
            'gender' => 'Male',
            'phone_number' => '255652762026',
            'branch_id' => 1,
        ]);

        //navigate to user table
        User::create([
            'id' => 1,
            'member_id' => 1,
            'role_id' => 1,
            'password' => Hash::make('password'),
        ])->assignRole('Super-Admin');
    }
}
