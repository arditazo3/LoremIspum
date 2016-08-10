<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('id_invoice', 50)->nullable();

            $table->integer('id_category')->unsigned()->default(0);
            $table->timestamp('date');
            $table->integer('teeth_no')->unsigned()->default(0);
            $table->text('description')->nullable();
            $table->integer('currency')->unsigned()->default(0);
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->unsigned()->default(0);
            $table->decimal('discount', 5, 2);
            $table->decimal('vat', 5, 2)->nullable();
            $table->text('clicnic_note')->nullable();

            $table->integer('id_job')->unsigned()->default(0);    // foreign key
            $table->string('id_dentist', 50);                     // foreign key

            $table->timestamps();

            $table->softDeletes();                           // softDelete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }
}
