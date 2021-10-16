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
            $table->bigInteger('offerNumber')->unsigned()->nullable();
            $table->bigInteger('reservationNumber')->unsigned()->nullable();
            $table->bigInteger('contractNumber')->unsigned()->nullable();
            $table->date('offerDate')->nullable();
            $table->date('reservationDate')->nullable();
            $table->date('contractDate')->nullable();
            // currentState is one of : ['offer', 'reservation', 'contract']
            $table->string('currentState')->nullable();
            $table->date('collectDate')->nullable();
            $table->date('returnDate')->nullable();
            $table->time('collectTime')->nullable();
            $table->time('returnTime')->nullable();
            $table->float('totalPrice', 15, 2)->nullable();
            $table->float('nettoPrice', 15, 2)->nullable();
            $table->float('taxValue', 15, 2)->nullable();
            $table->float('reservationDepositValue', 15, 2)->nullable();
            $table->date('reservationDepositDate')->nullable();
            $table->string('reservationDepositType')->nullable();
            $table->boolean('reservationDepositRecieved')->default(false);
            $table->float('finalPaymentValue', 15, 2)->nullable();
            $table->date('finalPaymentDate')->nullable();
            $table->string('finalPaymentType')->nullable();
            $table->boolean('finalPaymentRecieved')->default(false);
            $table->float('contractBail', 15, 2)->nullable();
            $table->date('contractBailDate')->nullable();
            $table->string('contractBailType')->nullable();
            $table->boolean('contractBailRecieved')->default(false);
            $table->boolean('contractBailReturned')->default(false);
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


            // Driver Values
            $table->bigInteger('driver_id')->nullable();
            $table->string('driver_pass_number')->nullable();
            $table->string('driver_name1');
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
