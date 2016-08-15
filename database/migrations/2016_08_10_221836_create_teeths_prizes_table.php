<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeethsPrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teeths_prizes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id')->index()->unsigned();
            $table->string('category', 255)->nullable();
            $table->string('detail', 250)->nullable();
            $table->timestamp('date');
            $table->integer('currency1')->unsigned()->default(0);
            $table->decimal('price1', 10, 2);
            $table->integer('currency2')->unsigned()->nullable();
            $table->decimal('price2', 10, 2)->nullable();
            $table->integer('currency3')->unsigned()->nullable();
            $table->decimal('price3', 10, 2)->nullable();
            $table->integer('currency4')->unsigned()->nullable();
            $table->decimal('price4', 10, 2)->nullable();
            $table->decimal('vat', 5, 2)->nullable();
            $table->integer('discount')->unsigned()->default(0);
            $table->string('position', 255)->nullable();
            $table->text('note')->nullable();

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
        Schema::drop('teeths_prizes');
    }
}
