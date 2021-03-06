<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->nullable();
            $table->text('slug')->nullable();
            $table->text('address')->nullable();
            $table->text('company_id')->nullable();
            $table->text('price')->nullable();
            $table->text('price2')->nullable();
            $table->text('desc')->nullable();
            $table->text('content')->nullable();
            $table->text('more_image')->nullable();
            $table->text('image')->nullable();
            $table->integer('hot')->nullable();
            $table->integer('status')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
