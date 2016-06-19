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

            $table->string('proffession', 50);
            $table->string('company_name', 255);
            $table->string('last_name', 255);
            $table->string('first_name', 255);
            $table->string('address', 255);
            $table->string('city', 100);
            $table->date('date_birth');
            $table->string('marital_status', 20);
            $table->string('language', 100);
            $table->string('sex', 50);
            $table->string('email', 255);
            $table->string('zip_code', 100);
            $table->string('birth_place', 200);
            $table->string('personal_phone', 30);
            $table->string('office_phone', 30);
            $table->string('fax', 30);
            $table->string('tax_code', 255);
            $table->string('photo', 255);
            $table->integer('type_photo')->unsigned()->default(0);
            $table->date('date_last_visit');
            $table->date('date_next_visit');
            $table->date('date_first_visit');
            $table->date('date_last_pay');
            $table->text('note');
            $table->integer('discount')->unsigned()->default(0);
            $table->string('insurance', 100);
            $table->integer('user_update')->unsigned()->default(0);
            $table->string('doctor_name', 100);
            $table->string('phone_doctor', 50);
            $table->string('adult_child', 10);
            $table->integer('age')->unsigned()->default(0);
            $table->string('barcode', 20);
            $table->string('province', 50);
            $table->string('id_family', 50);
            $table->integer('family_type')->unsigned()->default(0);
            $table->string('nation', 255);
            $table->string('site', 255);
            $table->text('note1');
            $table->text('note2');
            $table->text('note3');
            $table->text('note4');
            $table->text('note5');
            $table->string('sms_notify_news', 1);
            $table->string('patient_status', 30);
            $table->string('head_household', 1);

            $table->string('id_dentist', 50); // foreign key

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
        Schema::drop('patients');
    }
}
