<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            // Document internal Values
            $table->bigInteger('offer_number')->unsigned()->nullable();
            $table->bigInteger('reservation_number')->unsigned()->nullable();
            $table->bigInteger('contract_number')->unsigned()->nullable();
            $table->date('offer_date')->nullable();
            $table->date('reservation_date')->nullable();
            $table->date('contract_date')->nullable();
            // currentState is one of : ['offer', 'reservation', 'contract']
            $table->string('current_state')->nullable();
            $table->date('collect_date')->nullable();
            $table->date('return_date')->nullable();
            $table->time('collect_time')->nullable();
            $table->time('return_time')->nullable();
            $table->float('total_price', 15, 2)->nullable();
            $table->float('netto_price', 15, 2)->nullable();
            $table->float('tax_value', 15, 2)->nullable();
            $table->float('reservation_deposit_value', 15, 2)->nullable();
            $table->date('reservation_deposit_date')->nullable();
            $table->string('reservation_deposit_type')->nullable();
            $table->boolean('reservation_deposit_recieved')->default(false);
            $table->float('final_payment_value', 15, 2)->nullable();
            $table->date('final_payment_date')->nullable();
            $table->string('final_payment_type')->nullable();
            $table->boolean('final_payment_recieved')->default(false);
            $table->float('contract_bail', 15, 2)->nullable();
            $table->date('contract_bail_date')->nullable();
            $table->string('contract_bail_type')->nullable();
            $table->string('contract_bail_return_type')->nullable();
            $table->boolean('contract_bail_recieved')->default(false)->nullable();
            $table->boolean('contract_bail_returned')->default(false)->nullable();
            $table->longText('comment')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->timestamps();

            // Customer Values
            $table->bigInteger('customer_id')->nullable();
            $table->string('customer_pass_number')->nullable();
            $table->string('customer_name1');
            $table->string('customer_name2')->nullable();
            $table->string('customer_street')->nullable();
            $table->integer('customer_plz')->nullable();
            $table->string('customer_city')->nullable();
            $table->date('customer_birth_date')->nullable();
            $table->string('customer_birth_city')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_car_number')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_driving_license_no')->nullable();
            $table->string('customer_driving_license_class')->nullable();
            $table->longText('customer_comment')->nullable();

            // Driver Values
            $table->bigInteger('driver_id')->nullable();
            $table->string('driver_pass_number')->nullable();
            $table->string('driver_name1')->nullable();
            $table->string('driver_name2')->nullable();
            $table->string('driver_street')->nullable();
            $table->integer('driver_plz')->nullable();
            $table->string('driver_city')->nullable();
            $table->date('driver_birth_date')->nullable();
            $table->string('driver_birth_city')->nullable();
            $table->string('driver_phone')->nullable();
            $table->string('driver_car_number')->nullable();
            $table->string('driver_email')->nullable();
            $table->string('driver_driving_license_no')->nullable();
            $table->string('driver_driving_license_class')->nullable();
            $table->longText('driver_comment')->nullable();

            // Vehicle Values
            $table->bigInteger('vehicle_id')->nullable();
            $table->string('vehicle_title')->nullable();
            $table->string('vehicle_plateNumber')->nullable();
            $table->string('vehicle_chassisNumber')->nullable();
            $table->string('vehicle_totalWeight')->nullable();
            $table->string('vehicle_usableWeight')->nullable();
            $table->string('vehicle_loading_size')->nullable();
            $table->longText('vehicle_comment')->nullable();

            // Settings
            $table->integer('vat');
            $table->longText('offer_note')->nullable();
            $table->longText('reservation_note')->nullable();
            $table->longText('contract_note')->nullable();
            $table->longText('document_footer')->nullable();
            $table->longText('contactdata')->nullable();

            // Collect Address
            $table->bigInteger('collect_address_id')->nullable();

            // Equipment List
            $table->longText('selectedEquipmentList')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
