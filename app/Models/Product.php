<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasUuids;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');    
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class, "product_id", "id");
    }

    public function likedByCustomers() : BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'customers_likes_products', 'product_id', 'customer_id')
            ->withPivot('created_at');
    }
}
