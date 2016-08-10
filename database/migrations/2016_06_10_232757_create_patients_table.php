<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            // primary key
            $table->string('id_patient');

            $table->string('proffession', 50)->nullable();
            $table->string('company_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('first_name', 255);
            $table->string('address', 255)->nullable();
            $table->string('city', 100)->nullable();
            $table->date('date_birth')->nullable();
            $table->string('marital_status', 20)->nullable();
            $table->string('language', 100)->nullable();
            $table->string('sex', 50)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('zip_code', 100)->nullable();
            $table->string('birth_place', 200)->nullable();
            $table->string('personal_phone', 30)->nullable();
            $table->string('office_phone', 30)->nullable();
            $table->string('fax', 30)->nullable();
            $table->string('tax_code', 255)->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('image_path', 255)->nullable();
            $table->integer('image_id')->index()->unsigned();
            $table->integer('type_photo')->unsigned()->default(0);
            $table->date('date_last_visit')->nullable();
            $table->date('date_next_visit')->nullable();
            $table->date('date_first_visit')->nullable();
            $table->date('date_last_pay')->nullable();
            $table->text('note')->nullable();
            $table->integer('discount')->unsigned()->default(0);
            $table->string('insurance', 100)->nullable();
            $table->integer('user_update')->unsigned()->default(0);
            $table->string('doctor_name', 100)->nullable();
            $table->string('phone_doctor', 50)->nullable();
            $table->string('adult_child', 10)->nullable();
            $table->integer('age')->unsigned()->default(0);
            $table->string('barcode', 20)->nullable();
            $table->string('province', 50)->nullable();
            $table->string('id_family', 50)->nullable();
            $table->integer('family_type')->unsigned()->default(0);
            $table->string('nation', 255)->nullable();
            $table->string('site', 255)->nullable();
            $table->text('note1')->nullable();
            $table->text('note2')->nullable();
            $table->text('note3')->nullable();
            $table->text('note4')->nullable();
            $table->text('note5')->nullable();
            $table->string('sms_notify_news', 1)->nullable();
            $table->string('patient_status', 30)->nullable();
            $table->string('head_household', 1)->nullable();

            $table->string('id_dentist', 50); // foreign key

            $table->timestamps();

            $table->primary('id_patient');
            // softDelete
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('patients');
    }
}
