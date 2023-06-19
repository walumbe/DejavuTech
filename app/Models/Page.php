<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'date_created',
        'username',
        'product',
        'current_quantity',
        'transfered_qty',
        'department',
    ];
}
