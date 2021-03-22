<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    use HasFactory;
    public $table = 'requests';

    protected $fillable = [
        'project',
        'item',
        'quantity',
        'units',
        'category'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Projects::class, 'project');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Items', 'item');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category');
    }

}
