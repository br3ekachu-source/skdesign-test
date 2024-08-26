<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\StoreProduct;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'eId', 'title', 'price', 'description'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    protected $dispatchesEvents = [
        'created' => StoreProduct::class,
        'updated' => StoreProduct::class
    ];

}
