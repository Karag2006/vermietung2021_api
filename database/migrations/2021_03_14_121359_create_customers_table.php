<?php

/*
 *
 *  (c) Martin Richter - 03/2021
 *
 *
*/

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            // Autoincrement ID
            $table->bigInteger('id')->autoIncrement();
            // Personalausweis / Pass /.... Nummer
            $table->string('pass_number')->nullable();
            // Name1 z.B. Firmenname oder Vor + Nachname
            $table->string('name1');
            // Name2 Falls Name1 zu klein ist
            $table->string('name2')->nullable();
            // Strasse und Hausnummer
            $table->string('street')->nullable();
            // Postleitzahl
            $table->integer('plz')->nullable();
            // Ort
            $table->string('city')->nullable();
            // Geburtsdatum
            $table->date('birth_date')->nullable();
            // Geburtsstadt
            $table->string('birth_city')->nullable();
            // Telefonnummer
            $table->string('phone')->nullable();
            // Kennzeichen vom Zugfahrzeug
            $table->string('car_number')->nullable();
            // Email Adresse
            $table->string('email')->nullable();
            // Führerschein Nummer
            $table->string('driving_license_no')->nullable();
            // Führerschein Klasse
            $table->string('driving_license_class')->nullable();
            $table->longText('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
            DB::statement('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
