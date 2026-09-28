<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $table = 'category';
    
    protected $fillable =[
        'name',

    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
