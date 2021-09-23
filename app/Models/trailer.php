<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trailer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'plateNumber',
        'chassisNumber',
        'totalWeight',
        'usableWeight',
        'loadingSize',
        'tuev'
    ];
}
