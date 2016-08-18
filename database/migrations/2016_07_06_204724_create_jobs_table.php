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

            $table->date('date');
            $table->string('teeth_no', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('shortCode', 255)->nullable();
            $table->text('desc_client')->nullable();
            $table->integer('currency')->unsigned()->default(0);
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->unsigned()->default(0);
            $table->decimal('discount', 5, 2);
            $table->decimal('vat', 5, 2)->nullable();
            $table->decimal('amount', 7, 2);
            $table->string('type_cure', 255)->nullable();
            $table->string('status_cure', 255)->nullable();
            $table->text('clicnic_note')->nullable();

            $table->string('id_patient');                               // foreign key
            $table->integer('id_job_detail')->unsigned()->default(0);   // foreign key
            $table->string('id_dentist', 50);                           // foreign key
			$table->integer('id_teeth_prizes')->unsigned()->default(0); // foreign key

            
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
