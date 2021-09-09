<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes, HasFactory;

    protected $appends = [
        'itemIdentifier'
    ];

    protected $dates = [
        'birth_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const DRIVING_LICENSE_CLASS_SELECT = [
        'b'   => 'B',
        'be'  => 'BE',
        'b96' => 'B96',
        '3'   => 'Klasse 3'
    ];

    // Diese Felder können per Massenzuweisung gefüllt werden
    protected $fillable = [
        'pass_number',
        'name1',
        'name2',
        'birth_date',
        'birth_city',
        'street',
        'plz',
        'city',
        'phone',
        'email',
        'driving_license_no',
        'driving_license_class',
        'car_number',
        'customer_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getItemIdentifierAttribute()
    {
        return $this->name1;
    }
    public function getBirthDateAttribute($value)
    {
        //return $value ? Carbon::parse($value)->format(config('custom.date_format')) : null;
    }
    public function setBirthDateAttribute($value)
    {
        //$this->attributes['birth_date'] = $value ? Carbon::createFromFormat(config('custom.date_format'), $value)->format('Y-m-d') : null;
    }

}
