<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class trailer extends Model
{
    use HasFactory;

    protected $dates = [
        'tuev',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'plateNumber',
        'chassisNumber',
        'totalWeight',
        'usableWeight',
        'loadingSize',
        'tuev'
    ];

    public function getTuevAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('custom.date_format')) : null;
    }
    public function setTuevAttribute($value)
    {
        $this->attributes['tuev'] = $value ? Carbon::createFromFormat(config('custom.date_format'), $value)->format('Y-m-d') : null;
    }
}
