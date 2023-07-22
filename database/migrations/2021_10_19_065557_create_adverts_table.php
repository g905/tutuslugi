<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('category');
            $table->integer('sub_category');
            $table->text('text');
            $table->float('price');
            $table->integer('user_id');
            $table->string('phone');
            $table->string('adress');
            $table->integer('region_id');
            $table->integer('parent_region_id');
            $table->integer('status');
            $table->dateTime('date_start');
            $table->dateTime('date_up');
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
        Schema::dropIfExists('adverts');
    }
}
