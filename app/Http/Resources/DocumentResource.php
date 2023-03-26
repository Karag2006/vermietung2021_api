<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $customer = [
            'id' => $this->customer_id,
            'pass_number' => $this->customer_pass_number,
            'name1' => $this->customer_name1,
            'name2' => $this->customer_name2,
            'street' => $this->customer_street,
            'plz' => $this->customer_plz,
            'city' => $this->customer_city,
            'birth_date' => $this->customer_birth_date,
            'birth_city' => $this->customer_birth_city,
            'phone' => $this->customer_phone,
            'car_number' => $this->customer_car_number,
            'email' => $this->customer_email,
            'driving_license_no' => $this->customer_driving_license_no,
            'driving_license_class' => $this->customer_driving_license_class,
            'comment' => $this->customer_comment,
        ];

        $driver = [
            'id' => $this->driver_id,
            'pass_number' => $this->driver_pass_number,
            'name1' => $this->driver_name1,
            'name2' => $this->driver_name2,
            'street' => $this->driver_street,
            'plz' => $this->driver_plz,
            'city' => $this->driver_city,
            'birth_date' => $this->driver_birth_date,
            'birth_city' => $this->driver_birth_city,
            'phone' => $this->driver_phone,
            'car_number' => $this->driver_car_number,
            'email' => $this->driver_email,
            'driving_license_no' => $this->driver_driving_license_no,
            'driving_license_class' => $this->driver_driving_license_class,
            'comment' => $this->driver_comment,
        ];

        $trailer = [
            'id' => $this->vehicle_id,
            'title' => $this->vehicle_title,
            'plateNumber' => $this->vehicle_plateNumber,
            'chassisNumber' => $this->vehicle_chassisNumber,
            'totalWeight' => $this->vehicle_totalWeight,
            'usableWeight' => $this->vehicle_usableWeight,
            'loading_size' => $this->vehicle_loading_size,
            'comment' => $this->vehicle_comment,
        ];

        $data = [
            'offer_number' => $this->offer_number,
            'reservation_number' => $this->reservation_number,
            'contract_number' => $this->contract_number,
            'offer_date' => $this->offer_date,
            'reservation_date' => $this->reservation_date,
            'contract_date' => $this->contract_date,
            'current_state' => $this->current_state,
            'collect_date' => $this->collect_date,
            'return_date' => $this->return_date,
            'collect_time' => $this->collect_time,
            'return_time' => $this->return_time,
            'total_price' => $this->total_price,
            'netto_price' => $this->netto_price,
            'tax_value' => $this->tax_value,
            'reservation_deposit_value' => $this->reservation_deposit_value,
            'reservation_deposit_date' => $this->reservation_deposit_date,
            'reservation_deposit_type' => $this->reservation_deposit_type,
            'reservation_deposit_recieved' => $this->reservation_deposit_recieved,
            'final_payment_value' => $this->final_payment_value,
            'final_payment_date' => $this->final_payment_date,
            'final_payment_type' => $this->final_payment_type,
            'final_payment_recieved' => $this->final_payment_recieved,
            'contract_bail' => $this->contract_bail,
            'contract_bail_date' => $this->contract_bail_date,
            'contract_bail_type' => $this->contract_bail_type,
            'contract_bail_return_type' => $this->contract_bail_return_type,
            'contract_bail_recieved' => $this->contract_bail_recieved,
            'contract_bail_returned' => $this->contract_bail_returned,
            'comment' => $this->comment,
            'user_id' => $this->user_id,
            'selectedEquipmentList' => json_decode($this->selectedEquipmentList),
            'collect_address_id' => $this->collect_address_id,
        ];

        $settings = [
            'vat' => $this->vat,
            'offer_note' => $this->offer_note,
            'reservation_note' => $this->reservation_note,
            'contract_note' => $this->contract_note,
            'document_footer' => $this->document_footer,
            'contactdata' => $this->contactdata,
        ];

        return [
            'customer' => $customer,
            'driver' => $driver,
            'trailer' => $trailer,
            'data' => $data,
            'settings' => $settings
        ];
    }
}
