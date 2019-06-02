<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddedByFldMdcn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiary_medicines', function (Blueprint $table) {
            $table->bigInteger('added_by', false, true)->after('medical_type');
        });

        Schema::table('beneficiary_medicines', function($table) {
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
        Schema::table('beneficiary_medicines', function (Blueprint $table) {
            //
        });
    }
}
