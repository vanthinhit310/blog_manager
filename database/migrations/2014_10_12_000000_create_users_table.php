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
            $table->bigIncrements('id');
            $table->string('firstName',60);
            $table->string('middleName',60)->nullable();
            $table->string('lastName',60);
            $table->string('email',50)->unique();
            $table->string('password');
            $table->string('mobile',30)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->dateTime('register_at')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->text('intro')->nullable();
            $table->mediumText('profile')->nullable();
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
