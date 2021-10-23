<?php

namespace App\Models;

use App\Http\Controllers\CollectAddressController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Document extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function driver()
    {
        return $this->belongsTo(Customer::class, 'driver_id');
    }
    public function vehicle()
    {
        return $this->belongsTo(trailer::class, 'vehicle_id');
    }
    public function collectAddress()
    {
        return $this->belongsTo(CollectAddress::class, 'collect_address_id');
    }

    protected $dates = [
        'offerDate',
        'reservationDate',
        'contractDate',
        'collectDate',
        'returnDate',
        'reservationDepositDate',
        'finalPaymentDate',
        'contractBailDate',
        'customer_birth_date',
        'driver_birth_date',
    ];

    protected $fillable = [
        // Document internal Values
        'offerNumber',
        'reservationNumber',
        'contractNumber',
        'offerDate',
        'reservationDate',
        'contractDate',
        'currentState',
        'collectDate',
        'returnDate',
        'collectTime',
        'returnTime',
        'totalPrice',
        'nettoPrice',
        'taxValue',
        'reservationDepositValue',
        'reservationDepositDate',
        'reservationDepositType',
        'reservationDepositRecieved',
        'finalPaymentValue',
        'finalPaymentDate',
        'finalPaymentType',
        'finalPaymentRecieved',
        'contractBail',
        'contractBailDate',
        'contractBailType',
        'contractBailRecieved',
        'contractBailReturned',



        // Customer Values
        'customer_id',
        'customer_pass_number',
        'customer_name1',
        'customer_name2',
        'customer_street',
        'customer_plz',
        'customer_city',
        'customer_birth_date',
        'customer_birth_city',
        'customer_phone',
        'customer_car_number',
        'customer_email',
        'customer_driving_license_no',
        'customer_driving_license_class',


        // Driver Values
        'driver_id',
        'driver_pass_number',
        'driver_name1',
        'driver_name2',
        'driver_street',
        'driver_plz',
        'driver_city',
        'driver_birth_date',
        'driver_birth_city',
        'driver_phone',
        'driver_car_number',
        'driver_email',
        'driver_driving_license_no',
        'driver_driving_license_class',


        // Vehicle Values
        'vehicle_id',
        'vehicle_title',
        'vehicle_plateNumber',
        'vehicle_chassisNumber',
        'vehicle_totalWeight',
        'vehicle_usableWeight',
        'vehicle_loadingSize',


        // Settings
        'vat',
        'offer_note',
        'reservation_note',
        'contract_note',
        'document_footer',
        'contactdata',


        // Collect Address
        'collect_address_id',
    ];
}
