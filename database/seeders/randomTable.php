<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\traffic;


class randomTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $start = '2020-01-01';
        $end = '2022-12-12';
        $current = $start;

        while ($current <= $end) {
            for ($k = 1; $k <= 4; $k++) {
                traffic::create([
                    'date' => $current,
                    'junc' => $k,
                    'carCount' => mt_rand(10,150),
                ]);
            }
            
            $current = date('Y-m-d', strtotime($current . ' +1 day'));
        }
    }
}
