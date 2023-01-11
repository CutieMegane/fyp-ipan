<?php

namespace App\Imports;

use App\Models\traffic;
use Maatwebsite\Excel\Concerns\ToModel;

class TrafficImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new traffic([
            'DateAndTime' => $row[0],
            'Junction' => $row[1],
            'Vehicles' => $row[2],
            'number' => $row[3],
        ]);
    }
}
