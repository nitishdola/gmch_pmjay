<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMedcnreturnFlds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiary_medicine_returns', function (Blueprint $table) {
            $table->string('medical_type', 255)->after('bill_date')->nullable();
            $table->bigInteger('added_by', false, true)->after('medical_type');
        });

        Schema::table('beneficiary_medicine_returns', function($table) {
           $table->foreign('added_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiary_medicine_returns', function (Blueprint $table) {
            //
        });
    }
}
