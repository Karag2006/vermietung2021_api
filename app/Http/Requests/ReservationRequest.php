<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $customerRules = [
            'customer.pass_number' => 'string|min:8|max:30|nullable',
            'customer.name1' => 'required|string|min:5|max:100',
            'customer.name2' => 'string|max:100|nullable',
            'customer.birth_date' => 'nullable|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'customer.birth_city' => 'string|min:3|max:50|nullable',
            'customer.plz' => 'nullable|regex:/^(?:[0-9]{5})$/',
            'customer.city' => 'nullable|string|min:3|max:50',
            'customer.street' => 'nullable|string|min:3|max:50',
            'customer.phone' => 'string|min:6|max:20|nullable',
            'customer.car_number' => 'string|min:5|max:15|nullable',
            'customer.email' => 'email|nullable',
            'customer.driving_license_no' => 'string|min:6|max:15|nullable',
            'customer.driving_license_class' => [
                Rule::in(['B', 'BE', 'B96', 'Klasse 3']),
                'nullable'
            ],
            'customer.comment' => 'string|max:1000|nullable',
        ];

        $driverRules = [
            'driver.pass_number' => 'string|min:8|max:30|nullable',
            'driver.name1' => 'string|min:5|max:100|nullable',
            'driver.name2' => 'string|max:100|nullable',
            'driver.birth_date' => 'nullable|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'driver.birth_city' => 'string|min:3|max:50|nullable',
            'driver.plz' => 'nullable|regex:/^(?:[0-9]{5})$/',
            'driver.city' => 'string|min:3|max:50|nullable',
            'driver.street' => 'string|min:3|max:50|nullable',
            'driver.phone' => 'string|min:6|max:20|nullable',
            'driver.car_number' => 'string|min:5|max:15|nullable',
            'driver.email' => 'email|nullable',
            'driver.driving_license_no' => 'string|min:6|max:15|nullable',
            'driver.driving_license_class' => [
                Rule::in(['B', 'BE', 'B96', 'Klasse 3']),
                'nullable'
            ],
            'driver.comment' => 'string|max:1000|nullable',
        ];

        $trailerRules = [
            'trailer.title' => 'required|string|min:8|max:50',
            'trailer.plateNumber' => 'required|string|max:15',
            'trailer.chassisNumber' => 'required|string|max:30',
            'trailer.totalWeight' => 'required|integer|min:500|max:3500',
            'trailer.usableWeight' => 'required|integer|min:1|lt:trailer.totalWeight',
            'trailer.loading_size' => 'required|array',
            'trailer.loading_size.0' => 'required|integer|min:100|max:800',
            'trailer.loading_size.1' => 'required|integer|min:50|max:250',
            'trailer.loading_size.2' => 'nullable|integer|min:1|max:250',
            'trailer.comment' => 'string|max:1000|nullable',
        ];

        $reservationRules = [
            'data.collect_date' => 'required|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'data.return_date' => 'required|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'data.collect_time' => 'required|regex:/^(?:[0-9]{2})\:(?:[0-9]{2})$/',
            'data.return_time' => 'required|regex:/^(?:[0-9]{2})\:(?:[0-9]{2})$/',
            'data.collect_address_id' => 'required|integer|max:100',
            'data.total_price' => 'required|numeric|min:1|max:9999',
            'data.netto_price' => 'required|numeric|lte:data.total_price',
            'data.tax_value' => 'required|numeric|lte:data.total_price',
            'data.reservation_deposit_value' => 'nullable|required_if:data.reservation_deposit_recieved,true|numeric|lte:data.total_price',
            'data.reservation_deposit_date' => 'nullable|required_if:data.reservation_deposit_recieved,true|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'data.reservation_deposit_type' => [
                'nullable',
                'required_if:data.reservation_deposit_recieved,true',
                Rule::in(['Bar', 'EC-Karte', 'Überweisung']),
            ],
            'data.reservation_deposit_recieved' => 'nullable|boolean',
            'data.final_payment_value' => 'required|numeric|lte:data.total_price',
            'data.final_payment_date' => 'nullable|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'data.final_payment_type' => [
                'nullable',
                Rule::in(['Bar', 'EC-Karte', 'Überweisung']),
            ],
            'data.final_payment_recieved' => 'nullable|boolean',
            'data.comment' => 'string|max:1000|nullable',
        ];

        $allRules = array_merge($customerRules, $driverRules, $trailerRules, $reservationRules);

        return $allRules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'customer.pass_number' => 'Kunde - Ausweisnummer',
            'customer.phone' => 'Kunde - Telefon',
            'customer.driving_license_no' => 'Kunde - Führerschein Nr.',
            'driver.pass_number' => 'Fahrer - Ausweisnummer',
            'driver.phone' => 'Fahrer - Telefon',
            'driver.driving_license_no' => 'Fahrer - Führerschein Nr.',
            'data.reservation_deposit_recieved' => 'Anzahlung eingegangen',
            'data.reservation_deposit_value' => 'Anzahlung',
        ];
    }
}
