<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Items extends Model
{
    use HasFactory;
    protected $table = 'itemList';

    protected $fillable = [
        'productcode',
        'ProductName',
        'ActiveIngredient',
        'NHISCode',
        'UnitPrice',
        'Credit',
        'RecorderLevel',
        'Pack',
        'SubCategory',
        'location',
        'expirable',
        'PLME',
        'updated_by',
        'bar_code',
        'drugcategory'
    ];

    public function order()
    {
        return $this->hasMany(Orders::class);
    }
}
