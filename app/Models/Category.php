<?php

namespace App\Models;

use App\Models\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        "id",
        "name",
        "description"
    ];

    protected static function booted()
    {
        parent::booted();
        
        self::addGlobalScope(new IsActiveScope);
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');    
    }

    public function reviews() : HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Product::class,
            "category_id",
            "product_id",
            "id",
            "id"
        );
    }
}
