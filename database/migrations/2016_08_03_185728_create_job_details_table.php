<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_details', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('id_category')->unsigned()->default(0);
            $table->timestamp('date');
            $table->integer('teeth_no')->unsigned()->default(0);
            $table->text('description');
            $table->integer('currency')->unsigned()->default(0);
            $table->decimal('price', 7, 2);
            $table->integer('quantity')->unsigned()->default(0);
            $table->decimal('discount', 5, 2);
            $table->decimal('vat', 5, 2);
            $table->text('clicnic_note');

            $table->integer('id_job')->unsigned()->default(0);    // foreign key
            $table->string('id_dentist', 50);                     // foreign key

            $table->timestamps();

            $table->softDeletes();                                // softDelete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('job_details');
    }
}
