<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectAddress extends Model
{
    use HasFactory;

    public function Documents(){
        return $this->hasMany(Document::class, 'collect_address_id');
    }

    protected $fillable = [
        'name',
        'address',
    ];
}
