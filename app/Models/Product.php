<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $casts = [
        'price' => 'float'
    ];

    protected $fillable = [
        'title',
        'description',
        'price',
        'image'
    ];

    public function validationRules($id = null){
        return [
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
        ];
    }
}
