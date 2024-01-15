<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class Voucher extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'vouchers';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public function scopeActive(Builder $builder) : void
    {
        $builder->where('is_active', true);
    }

    public function scopeNonActive(Builder $builder) : void
    {
        $builder->where('is_active', false);
    }
}
