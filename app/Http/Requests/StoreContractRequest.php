<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContractRequest extends FormRequest
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
            'customer_pass_number' => 'required_without:driver_pass_number|string|min:8|max:30|nullable',
            'customer_name1' => 'required|string|min:5|max:50',
            'customer_name2' => 'string|min:5|max:50|nullable',
            'customer_birth_date' => 'required_with:customer_pass_number|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/|nullable',
            'customer_birth_city' => 'required_with:customer_pass_number|string|min:3|max:50|nullable',
            'customer_plz' => 'required|regex:/^(?:[0-9]{5})$/',
            'customer_city' => 'required|string|min:3|max:50',
            'customer_street' => 'required|string|min:3|max:50',
            'customer_phone' => 'required_without:driver_phone|string|min:6|max:20|nullable',
            'customer_car_number' => 'string|min:5|max:15|nullable',
            'customer_email' => 'email|nullable',
            'customer_driving_license_no' => 'required_without:driver_driving_license_no|string|min:6|max:15|nullable',
            'customer_driving_license_class' => [
                'required_with:customer_driving_license_no',
                Rule::in(['B', 'BE', 'B96', 'Klasse 3']), 'nullable'
            ],
            'customer_comment' => 'string|max:1000|nullable',
        ];

        $driverRules = [
            'driver_pass_number' => 'required_without:customer_pass_number|string|min:8|max:30|nullable',
            'driver_name1' => 'required_with:driver_pass_number|string|min:5|max:50|nullable',
            'driver_name2' => 'string|min:5|max:50|nullable',
            'driver_birth_date' => 'required_with:driver_pass_number|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/|nullable',
            'driver_birth_city' => 'required_with:driver_pass_number|string|min:3|max:50|nullable',
            'driver_plz' => 'required_with:driver_pass_number|regex:/^(?:[0-9]{5})$/|nullable',
            'driver_city' => 'required_with:driver_pass_number|string|min:3|max:50|nullable',
            'driver_street' => 'required_with:driver_pass_number|string|min:3|max:50|nullable',
            'driver_phone' => 'required_without:customer_phone|string|min:6|max:20|nullable',
            'driver_car_number' => 'string|min:5|max:15|nullable',
            'driver_email' => 'email|nullable',
            'driver_driving_license_no' => 'required_with:driver_pass_number|string|min:6|max:15|nullable',
            'driver_driving_license_class' => [
                'required_with:driver_driving_license_no',
                Rule::in(['B', 'BE', 'B96', 'Klasse 3']), 'nullable'
            ],
            'driver_comment' => 'string|max:1000|nullable',
        ];

        $trailerRules = [
            'vehicle_title' => 'required|string|min:8|max:50',
            'vehicle_plateNumber' => 'required|string|max:15',
            'vehicle_chassisNumber' => 'required|string|max:30',
            'vehicle_totalWeight' => 'required|integer|min:500|max:3500',
            'vehicle_usableWeight' => 'required|integer|min:1|lt:vehicle_totalWeight',
            'vehicle_loading_size' => 'required|array',
            'vehicle_loading_size.0' => 'required|integer|min:100|max:800',
            'vehicle_loading_size.1' => 'required|integer|min:50|max:250',
            'vehicle_loading_size.2' => 'nullable|integer|min:1|max:250',
            'vehicle_comment' => 'string|max:1000|nullable',
        ];

        $contractRules = [
            'collect_date' => 'required|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'return_date' => 'required|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'collect_time' => 'required|regex:/^(?:[0-9]{2})\:(?:[0-9]{2})$/',
            'return_time' => 'required|regex:/^(?:[0-9]{2})\:(?:[0-9]{2})$/',
            'collect_address_id' => 'required|integer|max:100',
            'total_price' => 'required|numeric|min:1|max:9999',
            'netto_price' => 'required|numeric|lte:total_price',
            'tax_value' => 'required|numeric|lte:total_price',
            'reservation_deposit_value' => 'nullable|required_if:reservation_deposit_recieved,true|numeric|lte:total_price',
            'reservation_deposit_date' => 'nullable|required_if:reservation_deposit_recieved,true|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'reservation_deposit_type' => [
                'nullable',
                'required_if:reservation_deposit_recieved,true',
                Rule::in(['Bar', 'EC-Karte', 'Überweisung']),
            ],
            'reservation_deposit_recieved' => 'nullable|boolean',
            'final_payment_value' => 'required|numeric|lte:total_price',
            'final_payment_date' => 'required|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'final_payment_type' => [
                'required',
                Rule::in(['Bar', 'EC-Karte', 'Überweisung']),
            ],
            'final_payment_recieved' => 'nullable|boolean',
            'contract_bail' => 'nullable|numeric|required_if:contract_bail_recieved,true',
            'contract_bail_date' => 'nullable|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'contract_bail_type' => [
                'nullable',
                'required_if:contract_bail_recieved,true',
                Rule::in(['Bar', 'EC-Karte', 'Überweisung']),
            ],
            'contract_bail_return_type' => [
                'nullable',
                'required_if:contract_bail_returned,true',
                Rule::in(['Bar', 'EC-Karte', 'Überweisung']),
            ],
            'contract_bail_recieved' => 'nullable|boolean',
            'contract_bail_returned' => 'nullable|boolean',
            'comment' => 'string|max:1000|nullable',
        ];

        $allRules = array_merge($customerRules, $driverRules, $trailerRules, $contractRules);

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
            'customer_pass_number' => 'Kunde - Ausweisnummer',
            'customer_phone' => 'Kunde - Telefon',
            'customer_driving_license_no' => 'Kunde - Führerschein Nr.',
            'driver_pass_number' => 'Fahrer - Ausweisnummer',
            'driver_phone' => 'Fahrer - Telefon',
            'driver_driving_license_no' => 'Fahrer - Führerschein Nr.',
            'reservation_deposit_recieved' => 'Anzahlung eingegangen',
            'reservation_deposit_value' => 'Anzahlung',
        ];
    }
}
