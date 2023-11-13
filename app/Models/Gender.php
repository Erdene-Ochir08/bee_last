<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;
    protected $table = 'genders';
    protected $guarded = [];


    public function products()
    {
        return $this->hasMany(Product::class, 'gender_id', 'id');
    }


}
