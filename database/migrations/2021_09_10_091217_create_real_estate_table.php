<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealEstateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->text('address')->nullable();
            $table->text('object')->nullable();
            $table->text('need')->nullable();
            $table->text('type_housing')->nullable();
            $table->integer('projects_id')->nullable();
            $table->integer('land_area')->nullable();
            $table->integer('usable_area')->nullable();
            $table->integer('price')->nullable();
            $table->integer('price2')->nullable();
            $table->integer('bedroom')->nullable();
            $table->integer('bathroom')->nullable();
            $table->integer('number_floors')->nullable();
            $table->text('direction_house')->nullable();
            $table->text('balcony_direction')->nullable();
            $table->text('frontispiece')->nullable();
            $table->text('image')->nullable();
            $table->text('more_image')->nullable();
            $table->text('desc')->nullable();
            $table->text('content')->nullable();
            $table->text('status')->nullable();
            $table->text('startDate')->nullable();
            $table->text('endDate')->nullable();
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
        Schema::dropIfExists('real_estate');
    }
}
