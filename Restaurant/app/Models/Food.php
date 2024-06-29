<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    //Các trường trong csdl được gắn giá trị
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'sale',
        'price',
        'image',
        'slug',
        'category_id',
    ];

    protected $table = 'food';
    //  định nghĩa mối quan hệ food thuộc về category
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
