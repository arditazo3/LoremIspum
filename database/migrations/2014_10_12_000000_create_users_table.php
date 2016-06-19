<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');

            // make query little bit faster, positive no and not null
            // if is 0 the user is not active, if is 1 is active
            $table->integer('role_id')->index()->unsigned()->nullable();
            $table->integer('image_id')->index()->unsigned()->nullable();
            $table->integer('is_active')->default(0);
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('email', 200)->unique();
            $table->string('address', 255);
            $table->string('phone', 50);
            $table->string('password', 255);
            $table->integer('user_update')->unsigned()->default(0);

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
        Schema::drop('users');
    }
}
