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

            $table->string('id_invoice', 50);

            $table->integer('id_category')->unsigned()->default(0);
            $table->string('detail', 250);
            $table->string('short_detail', 100);
            $table->integer('currency1')->unsigned()->default(0);
            $table->decimal('price1', 7, 2);
            $table->integer('currency2')->unsigned()->default(0);
            $table->decimal('price2', 7, 2);
            $table->integer('currency3')->unsigned()->default(0);
            $table->decimal('price3', 7, 2);
            $table->integer('currency4')->unsigned()->default(0);
            $table->decimal('price4', 7, 2);
            $table->decimal('vat', 5, 2);
            $table->string('position', 255);
            $table->integer('object')->unsigned()->default(0);
            $table->integer('type_operation')->unsigned()->default(0);
            $table->text('note');

            $table->string('id_dentist', 50);                // foreign key

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
