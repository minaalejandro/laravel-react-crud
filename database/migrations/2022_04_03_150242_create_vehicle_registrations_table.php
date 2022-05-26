<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ownerIdentityNumber');
            $table->string('ownerDateOfBirthHijri');
            $table->string('ownerDateOfBirthGregorian');
            $table->string('sequenceNumber');
            $table->string('plateLetterRight');
            $table->string('plateLetterMiddle');
            $table->string('plateLetterLeft');
            $table->string('plateNumber');
            $table->string('plateType');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_registrations');
    }
};
