<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'category_id' => $row[0],
            'gender_id' => $row[1],
            'name' => $row[2],
            'slug' => $row[3],
            'brand' => $row[4],
            'small_description' => $row[5],
            'description' => $row[6],
            'sale_percent' => $row[7],
            'price' => $row[8],
            'quantity' => $row[9],
            'trending' => $row[10],
            'status' => $row[11],
        ]);
    }
}
