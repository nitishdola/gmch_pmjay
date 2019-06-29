<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBeneficiaryIDToHonorariums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('honorariums', function (Blueprint $table) {
            $table->bigInteger('beneficiary_detail_id', false, true)->after('id');
        });

        Schema::table('honorariums', function($table) {
           $table->foreign('beneficiary_detail_id', 'honorarium_frgn_id')->references('id')->on('beneficiary_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('honorariums', function (Blueprint $table) {
            //
        });
    }
}
