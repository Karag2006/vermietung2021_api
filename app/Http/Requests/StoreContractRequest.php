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
            'customer.pass_number' => 'required_without:driver.pass_number|string|min:8|max:30|nullable',
            'customer.name1' => 'required|string|min:5|max:50',
            'customer.name2' => 'string|min:5|max:50|nullable',
            'customer.birth_date' => 'required_with:customer.pass_number|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/|nullable',
            'customer.birth_city' => 'required_with:customer.pass_number|string|min:3|max:50|nullable',
            'customer.plz' => 'required|regex:/^(?:[0-9]{5})$/',
            'customer.city' => 'required|string|min:3|max:50',
            'customer.street' => 'required|string|min:3|max:50',
            'customer.phone' => 'required_without:driver.phone|string|min:6|max:20|nullable',
            'customer.car_number' => 'string|min:5|max:15|nullable',
            'customer.email' => 'email|nullable',
            'customer.driving_license_no' => 'required_without:driver.driving_license_no|string|min:6|max:15|nullable',
            'customer.driving_license_class' => [
                'required_with:customer.driving_license_no',
                Rule::in(['B', 'BE', 'B96', 'Klasse 3']),
                'nullable'
            ],
            'customer.comment' => 'string|max:1000|nullable',
        ];

        $driverRules = [
            'driver.pass_number' => 'required_without:customer.pass_number|string|min:8|max:30|nullable',
            'driver.name1' => 'required_with:driver.pass_number|string|min:5|max:50|nullable',
            'driver.name2' => 'string|max:50|nullable',
            'driver.birth_date' => 'required_with:driver.pass_number|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/|nullable',
            'driver.birth_city' => 'required_with:driver.pass_number|string|min:3|max:50|nullable',
            'driver.plz' => 'required_with:driver.pass_number|regex:/^(?:[0-9]{5})$/|nullable',
            'driver.city' => 'required_with:driver.pass_number|string|min:3|max:50|nullable',
            'driver.street' => 'required_with:driver.pass_number|string|min:3|max:50|nullable',
            'driver.phone' => 'required_without:customer.phone|string|min:6|max:20|nullable',
            'driver.car_number' => 'string|min:5|max:15|nullable',
            'driver.email' => 'email|nullable',
            'driver.driving_license_no' => 'required_with:driver.pass_number|string|min:6|max:15|nullable',
            'driver.driving_license_class' => [
                'required_with:driver.driving_license_no',
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

        $contractRules = [
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
            'data.final_payment_date' => 'required|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'data.final_payment_type' => [
                'required',
                Rule::in(['Bar', 'EC-Karte', 'Überweisung']),
            ],
            'data.final_payment_recieved' => 'nullable|boolean',
            'data.contract_bail' => 'nullable|numeric|required_if:data.ontract_bail_recieved,true',
            'data.contract_bail_date' => 'nullable|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'data.contract_bail_type' => [
                'nullable',
                'required_if:data.contract_bail_recieved,true',
                Rule::in(['Bar', 'EC-Karte', 'Überweisung']),
            ],
            'data.contract_bail_return_type' => [
                'nullable',
                'required_if:data.contract_bail_returned,true',
                Rule::in(['Bar', 'EC-Karte', 'Überweisung']),
            ],
            'data.contract_bail_recieved' => 'nullable|boolean',
            'data.contract_bail_returned' => 'nullable|boolean',
            'data.comment' => 'string|max:1000|nullable',
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
