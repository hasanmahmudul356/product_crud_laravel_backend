<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $appends = ['image_url'];

    protected $casts = [
        'price' => 'float'
    ];

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'price',
        'image'
    ];

    public function getImageUrlAttribute(){
        if ($this->image){
            return route('image_view', ['w'=>200,'img'=>$this->image]);
        }else{
            return '';
        }
    }

    public function validationRules($id = null){
        return [
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'price' => 'required|numeric',
        ];
    }
}
