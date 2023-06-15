<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class debugUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //malas nk register
        DB::table('users')->insert([
            'name' => "Ralph",
            'email' => 'hell@lo',
            'password' => Hash::make('qweasdrf'),
        ]);
        DB::table('users')->insert([
            'name' => "irfan",
            'email' => 'irf@14',
            'password' => Hash::make('123'),
        ]);
    }
}
