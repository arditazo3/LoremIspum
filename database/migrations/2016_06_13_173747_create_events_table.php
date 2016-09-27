<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_patient')->index();
            $table->string('title', 250);
            $table->text('content');
            $table->string('backgroundColor');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->timestamps();

            // deleting the patient you are deleting all the childs related
            $table->foreign('id_patient')->references('id_patient')->on('patients');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
