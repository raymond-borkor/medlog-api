<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Projects extends Model
{
    use HasFactory;
    public $table = "projects";


    protected $fillable = [
        'project_code',
        'project_name',
        'date',
        'type',
        'initiator',
        'unit',
        'file_number',
        'mission_code',
        'location',
        'status',
        'init_contact',
        'email',
        'pharmacist',
        'exchange_rate',
        'order_number',
        'reference'
    ];

    public function order(): HasMany
    {
        return $this->hasMany(Orders::class);
    }
}
