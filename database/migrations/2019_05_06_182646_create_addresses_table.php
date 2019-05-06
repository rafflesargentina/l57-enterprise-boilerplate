<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('addressable_id');
            $table->string('addressable_type');
            $table->string('street_name')->nullable();
            $table->string('street_number')->nullable();
            $table->string('door_number', 5)->nullable();
            $table->string('floor_number', 5)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('sublocality')->nullable();
            $table->string('locality')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->boolean('featured')->nullable()->default(0);
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
        Schema::dropIfExists('addresses');
    }
}
