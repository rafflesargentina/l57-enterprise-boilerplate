<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'photos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug')->nullable();
                $table->unsignedInteger('photoable_id');
                $table->string('photoable_type');
                $table->unsignedInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('location');
                $table->string('name')->nullable();
                $table->text('description')->nullable();
                $table->boolean('featured')->nullable()->default(0);
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
        Schema::dropIfExists('photos');
    }
}
