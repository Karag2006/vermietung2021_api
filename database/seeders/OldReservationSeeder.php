<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OldReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oldData = DB::connection('mysql_old')->table('reservations')->get();
        foreach ($oldData as $oldEntry){
            $newEntry = [
                'reservation_number' => $oldEntry->id,
                'reservation_date' => $this->trimDate($oldEntry->updated_at),
                'current_state' => 'reservation',
                'collect_date' => $oldEntry->pick_up_date,
                'return_date' => $oldEntry->return_date,
                'collect_time' => $this->cleanupTime($oldEntry->pick_up_time),
                'return_time' => $this->cleanupTime($oldEntry->return_time),
                'total_price' => $oldEntry->price,
                'netto_price' => $oldEntry->netto_price,
                'tax_value' => $oldEntry->tax,
                'reservation_deposit_value' => $oldEntry->anzahlung,
                'reservation_Deposit_date' => $oldEntry->anzahlung_date,
                'reservation_deposit_type' => $this->setPaymentMethod($oldEntry->anzahlung_type),
                'reservation_deposit_recieved' => false,
                'final_payment_value' => $oldEntry->price - $oldEntry->anzahlung,
                'final_payment_recieved' => false,
                'contract_bail' => 100,
                'contract_bail_recieved' => false,
                'contract_bail_returned' => false,
                'comment' => $oldEntry->comment,
                'user_id' => $oldEntry->user_id,
                'collect_address_id' => $this->getCollectAddressIdFromName($oldEntry->pick_up_address),
                'selectedEquipmentList' => '[]',
            ];
            if ($oldEntry->customer_id) {
                $customer = DB::connection('mysql')->table('customers')->where('id', $oldEntry->customer_id)->first();
                $newEntry = array_merge($newEntry, [
                    'customer_id' => $customer->id,
                    'customer_pass_number' => $customer->pass_number,
                    'customer_name1' => $customer->name1,
                    'customer_name2' => $customer->name2,
                    'customer_street' => $customer->street,
                    'customer_plz' => $customer->plz,
                    'customer_city' => $customer->city,
                    'customer_birth_date' => $customer->birth_date,
                    'customer_birth_city' => $customer->birth_city,
                    'customer_phone' => $customer->phone,
                    'customer_car_number' => $customer->car_number,
                    'customer_email' => $customer->email,
                    'customer_driving_license_no' => $customer->driving_license_no,
                    'customer_driving_license_class' => $customer->driving_license_class,
                    'customer_comment' => $customer->comment,
                ]);
            }
            if ($oldEntry->additional_driver_id) {
                $driver = DB::connection('mysql')->table('customers')->where('id', $oldEntry->additional_driver_id)->first();
                $newEntry = array_merge($newEntry, [
                    'driver_id' => $driver->id,
                    'driver_pass_number' => $driver->pass_number,
                    'driver_name1' => $driver->name1,
                    'driver_name2' => $driver->name2,
                    'driver_street' => $driver->street,
                    'driver_plz' => $driver->plz,
                    'driver_city' => $driver->city,
                    'driver_birth_date' => $driver->birth_date,
                    'driver_birth_city' => $driver->birth_city,
                    'driver_phone' => $driver->phone,
                    'driver_car_number' => $driver->car_number,
                    'driver_email' => $driver->email,
                    'driver_driving_license_no' => $driver->driving_license_no,
                    'driver_driving_license_class' => $driver->driving_license_class,
                    'driver_comment' => $driver->comment,
                ]);
            }
            if($oldEntry->vehicle_id){
                $trailer = DB::connection('mysql')->table('trailers')->where('id', $oldEntry->vehicle_id)->first();
                $newEntry = array_merge($newEntry, [
                    'vehicle_id' => $trailer->id,
                    'vehicle_title' => $trailer->title,
                    'vehicle_plateNumber' => $trailer->plateNumber,
                    'vehicle_chassisNumber' => $trailer->chassisNumber,
                    'vehicle_totalWeight' => $trailer->totalWeight,
                    'vehicle_usableWeight' => $trailer->usableWeight,
                    'vehicle_loadingSize' => $trailer->loadingSize,
                    'vehicle_comment' => $trailer->comment,
                ]);
            }

            $settings = DB::connection('mysql')->table('options')->where('id', 1)->first();
            $newEntry = array_merge($newEntry, [
                'vat' => $settings->vat,
                'offer_note' => $settings->offer_note,
                'reservation_note' => $settings->reservation_note,
                'contract_note' => $settings->contract_note,
                'document_footer' => $settings->document_footer,
                'contactdata' => $settings->contactdata,
            ]);

            DB::connection('mysql')->table('documents')->insert($newEntry);
        }
    }

    private function trimDate($date){
        return substr($date, 0, 10);
    }

    // Set Seconds in the Time String to 0
    private function cleanupTime($time){
        return substr($time, 0, 6) . "00";
    }

    private function setPaymentMethod($method){
        if ($method == 'ueberweisung') {
            return 'Überweisung';
        }
        if ($method == 'ec_karte') {
            return 'EC-Karte';
        }
        return 'Bar';
    }

    private function getCollectAddressIdFromName($name){
        if($name == "horhausen_westerwald") return 1;
        if($name == "hennef_sieg") return 2;
        if($name == "hennef_knipp") return 3;
    }
}
