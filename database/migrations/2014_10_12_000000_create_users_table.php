<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_type');
            $table->smallInteger('status')->nullable();
            $table->smallInteger('confirm_phone')->nullable();
            $table->smallInteger('confirm_email')->nullable();
            $table->integer('views_total')->nullable();
            $table->integer('views_today')->nullable();
            $table->string('name');
            $table->string('phone')->nullable()->unique();
            $table->string('photo')->nullable();
            $table->string('hash');
            $table->string('email')->nullable()->unique();
            $table->timestamp('last_login')->nullable();
            $table->timestamp('last_phone_call')->nullable();
            $table->smallInteger('work_experience')->nullable();
            $table->smallInteger('discount')->nullable();
            $table->text('discount_text')->nullable();
            $table->text('about_text')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
