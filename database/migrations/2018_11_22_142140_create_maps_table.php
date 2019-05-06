<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'maps', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('mapable_id');
                $table->string('mapable_type');
                $table->float('lat', 11, 8)->nullable();
                $table->float('lng', 11, 8)->nullable();
                $table->unsignedInteger('zoom')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maps');
    }
}
