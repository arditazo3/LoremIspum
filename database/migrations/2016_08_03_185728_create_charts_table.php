<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charts', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('category_id')->index()->unsigned();
            $table->string('detail', 250)->nullable();
            $table->integer('currency1')->unsigned()->default(0);
            $table->decimal('price1', 7, 2)->nullable();
            $table->integer('currency2')->unsigned()->default(0);
            $table->decimal('price2', 7, 2)->nullable();
            $table->integer('currency3')->unsigned()->default(0);
            $table->decimal('price3', 7, 2)->nullable();
            $table->integer('currency4')->unsigned()->default(0);
            $table->decimal('price4', 7, 2)->nullable();
            $table->decimal('vat', 5, 2)->nullable();
            $table->string('position', 255)->nullable();
            $table->integer('object')->unsigned()->default(0);
            $table->integer('type_operation')->unsigned()->default(0);
            $table->text('note')->nullable();
            $table->timestamps();

            $table->integer('id_chart')->unsigned();         // foreign key
            $table->integer('id_user')->nullable();          // foreign key
            $table->string('id_patient');                    // foreign key

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
        Schema::drop('charts');
    }
}
