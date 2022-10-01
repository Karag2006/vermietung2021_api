<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes, HasFactory;

    public $incrementing = true;

    public function Documents()
    {
        return $this->hasMany(Document::class, 'customer_id');
    }
    public function DriverDocuments()
    {
        return $this->hasMany(Document::class, 'driver_id');
    }

    protected $appends = ['selector'];

    public function getSelectorAttribute(){
        return $this->name1 . ' - ' . $this->name2;
    }

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
        'comment',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('custom.date_format')) : null;
    }
    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $value ? Carbon::createFromFormat(config('custom.date_format'), $value)->format('Y-m-d') : null;
    }

}
